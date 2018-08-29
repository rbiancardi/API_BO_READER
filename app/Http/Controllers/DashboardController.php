<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\Product;
use App\MerchantProduct;
use App\Reader;
use App\Transaction;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start = \Carbon\Carbon::today()->subDays(90);
        $end = \Carbon\Carbon::today();
        $merchUsr = $this->merchantCount();
        $trx = $this->TrxCount();
        $branch = $this->branchCount();
        $product = $this->productCount();
        $merchDisable = $this->merchantDisable();
        $merchPercentage = $this->merchantPercentage();
        $readers = $this->readerCount();
        $readerPercentage = $this->readerPercentage();
        $trxTable = $this->transactions();
        $trxOk = $this->trxOk();
        $trxNOk = $this->trxNOk();
        $topBranch = $this->topBranch();
        $topEan = $this->topEan();
        $topVdp = $this->topVdp();

        return view('dashboard', ['merchUsr' => $merchUsr,
            'trx' => $trx,
            'start' => $start,
            'end' => $end,
            'branch' => $branch,
            'product' => $product,
            'merchDisable' => $merchDisable,
            'readers' => $readers,
            'merchPercentage' => $merchPercentage,
            'readerPercentage' => $readerPercentage,
            'trxTable' => $trxTable,
            'trxOk' => $trxOk,
            'trxNOk' => $trxNOk,
            'topBranch' => $topBranch,
            'topEan' => $topEan,
            'topVdp' => $topVdp
            ]);

    }
    

    public function trxCount()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        $trx = Transaction::whereIn('merchant_id', $merchUsr)->count();

        return $trx;

    }

    public function merchantCount()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants()->where('enable', '1')->count();

        return $merchUsr;

    }

    public function readerCount()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $readers = Reader::whereIn('merchant_id', $merchUsr)->count();

        return $readers;

    }

    public function readerDisable()
    {
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $readers = Reader::whereIn('merchant_id', $merchUsr)->where('enable', '0')->count();

        return $readers;
    }

    public function readerPercentage()
    {
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $readers = Reader::whereIn('merchant_id', $merchUsr)->count();
        $readerDisable = $this->readerDisable();
        $activeReaders =  $readers -  $readerDisable;
        $readerPercentage = round(($activeReaders * 100) / $readers, 2);

        return $readerPercentage;

    }

    public function merchantDisable()
    {

        $id = Auth::user()->id;
        $merchDisable = User::find($id)->merchants()->where('enable', '0')->count();

        return $merchDisable;

    }

    public function merchantPercentage()
    {
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants()->count();
        $merchDisable = $this->merchantDisable();

        $merchPercentage = round(($merchDisable * 100) / $merchUsr, 2);
        //dd($merchPercentage);

        return $merchPercentage;

    }

    public function branchCount()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branch = BranchOffice::whereIn('merchant_id', $merchUsr)->count();

        return $branch;

    }

    public function productCount()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $product = MerchantProduct::whereIn('merchant_id', $merchUsr)->count();
        return $product;

    }

  
    public function transactions()
    {

        $date = \Carbon\Carbon::today()->subDays(30);

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        $trxTable = Transaction::all()->whereIn('merchant_id', $merchUsr)
        ->where('created_at', '>=', date($date))->sortByDesc('id');
     
        return $trxTable;

    }

    public function trxOk(){

        $date = \Carbon\Carbon::today()->subDays(90);
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        $trxOk = Transaction::whereIn('merchant_id', $merchUsr)
        ->where('created_at', '>=', date($date))->where('trx_result_code', '=', '0')->count();
        

        return $trxOk;
    }


    public function trxNOk(){

        $date = \Carbon\Carbon::today()->subDays(90);
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        $trxNOk = Transaction::whereIn('merchant_id', $merchUsr)
        ->where('created_at', '>=', date($date))->where('trx_result_code', '<>', '0')->count();
        

        return $trxNOk;
    }



    public function topBranch(){
        
        $date = \Carbon\Carbon::today()->subDays(90);
        $merchant_id = Auth::user()->merchant_id;
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');

        $branch = DB::table('transactions')
             ->select(DB::raw('count(transactions.branch_name) as total, branch_name'))
             ->where('created_at', '>=', date($date))
             ->whereIn('merchant_id', $merchUsr)
             ->groupBy('transactions.branch_name')
             ->orderBy('total','desc')
             ->get();

             return ($branch);


    }      

    public function topEan(){

        $date = \Carbon\Carbon::today()->subDays(90);

        $merchant_id = Auth::user()->merchant_id;
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');

        $topEan = DB::table('transactions')
        ->join('products', 'transactions.barcode', '=' , 'products.barcode' )
        ->select(DB::raw('count(transactions.barcode) as total, products.description, products.barcode'))
        ->whereIn('transactions.merchant_id', $merchUsr)
        ->where('transactions.created_at', '>=', date($date))
             ->groupBy('transactions.barcode')
             ->orderBy('total','desc')
             ->limit('10')->get();

        return $topEan;
    }

    public function topVdp(){

        $date = \Carbon\Carbon::today()->subDays(90);
        $merchant_id = Auth::user()->merchant_id;
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');

        $topVdp = DB::table('transactions')
             ->select(DB::raw('count(transactions.reader_name) as total, reader_name'))
             ->where('created_at', '>=', date($date))
             ->whereIn('merchant_id', $merchUsr)
             ->groupBy('transactions.reader_name')
             ->orderBy('total','desc')
             ->get();

           

        return $topVdp;
    }

}
