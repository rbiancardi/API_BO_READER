<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\Reader;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $dt = $now->toDateTimeString();
        $daterange = request()->daterange;

        if (!is_null($daterange)) {
            $db_range = explode('A', $daterange);
            $trx_data = $this->trx_range($db_range);

            return view('transactions.searchTrx', ['dt' => $dt,
                'trx_data' => $trx_data,
            ]);
        } else {

            return view('transactions.searchTrx', ['dt' => $dt]);

        }

    }

    public function trxId(Request $request)
    {
        // dd($request);

        $trxId = $request->id;
        $barcode = $request->barcode;
        $daterange = request()->daterange;
        $db_range = explode('A', $daterange);
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        $from = trim($db_range[0]);
        $to = trim($db_range[1]);

        if (is_null($trxId) && is_null($barcode)) {
            $messages = [
                'required' => 'Para realizar esta busqueda es requerido el ingreso del Transaction Id o el Código de Barras'];
            $validator = \Validator::make($request->all(), ['barcode' => 'required', 'id' => 'required']);

            if ($validator->fails()) {
                return view('transactions.searchId')->withErrors($messages);
            }

        } elseif (is_null($barcode)) {

            $validator = $request->validate([
                'id' => 'required|numeric',
            ]);

            $trx_data = Transaction::whereIn('merchant_id', $merchUsr)
                ->where('id', $trxId)
                ->get();

            return view('transactions.searchId', ['trx_data' => $trx_data]);

        } elseif (is_null($trxId)) {

            $validator = $request->validate([
                'barcode' => 'required|min:4|numeric',
                'daterange' => 'required',
            ]);

            $trx_data = Transaction::whereIn('merchant_id', $merchUsr)
                ->where('barcode', $barcode)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id', 'desc')->limit(150)->get();

            return view('transactions.searchId', ['trx_data' => $trx_data]);

        } elseif (!is_null($trxId) && !is_null($barcode)) {

            $messages = [
                'required' => 'Debe ingresar el Id de la Transacción o el Código de Barras - No Ambos'];
            $validator = \Validator::make($request->all(), ['barcode' => 'required', 'id' => 'required']);
            //  dd($validator);

            if (!$validator->fails()) {
                return view('transactions.searchId')->withErrors($messages);
            }

        } else {

            return view('transactions.searchId');
        }
    }

    public function trx_range($db_range)
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        /*$trxOk = Transaction::whereIn('merchant_id', $merchUsr)
        ->where('created_at', '>=', date($date))->where('trx_result_code', '=', '0')->count();*/

        $from = trim($db_range[0]);
        $to = trim($db_range[1]);

        $trx = Transaction::whereIn('merchant_id', $merchUsr)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('id', 'desc')->limit(250)->get();

        return $trx;

    }

    public function trxBranchReader($db_range, $branch, $reader)
    {

        $id = Auth::user()->id;
        $merchUsrId = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        $from = trim($db_range[0]);
        $to = trim($db_range[1]);

        if ($reader == '' && $branch == '') {

            $reader = reader::whereIn('merchant_id', $merchUsrId)->pluck('reader_name');
            $branch = BranchOffice::whereIn('merchant_id', $merchUsrId)->pluck('branch_name');

            $trx = Transaction::whereIn('merchant_id', $merchUsr)
                ->whereIn('reader_name', $reader)
                ->whereIn('branch_name', $branch)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id', 'desc')->limit(250)->get();

        } elseif ($branch == '') {

            $branch = BranchOffice::whereIn('merchant_id', $merchUsrId)->pluck('branch_name');

            $trx = Transaction::whereIn('merchant_id', $merchUsr)
                ->where('reader_name', $reader)
                ->whereIn('branch_name', $branch)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id', 'desc')->limit(250)->get();

        } elseif ($reader == '') {
            $reader = reader::whereIn('merchant_id', $merchUsrId)->pluck('reader_name');

            $trx = Transaction::whereIn('merchant_id', $merchUsr)
                ->whereIn('reader_name', $reader)
                ->where('branch_name', $branch)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id', 'desc')->limit(250)->get();

        } else {

            $trx = Transaction::whereIn('merchant_id', $merchUsr)
                ->where('reader_name', $reader)
                ->where('branch_name', $branch)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id', 'desc')->limit(250)->get();
        }

        return $trx;

    }

    public function searchTrxReaderBranch(Request $request)
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->get();
        $branch = $branchOffices->sortBy('id');
        $merchReader = Reader::whereIn('merchant_id', $merchUsr)->get();
        $reader = $merchReader->sortBy('id');

        //Datos Busqueda
        $daterange = request()->daterange;
        $cbo_reader = request()->reader;
        $cbo_branch = request()->branch;

        if (isset($daterange)) {
            $db_range = explode('A', $daterange);
            $from = trim($db_range[0]);
            $to = trim($db_range[1]);

            $trx_data = $this->trxBranchReader($db_range, $cbo_branch, $cbo_reader);

            return view('transactions.searchTrxReaderBranch', ['branch' => $branch,
                'reader' => $reader,
                'trx_data' => $trx_data]);
        } else {

            return view('transactions.searchTrxReaderBranch', ['branch' => $branch,
                'reader' => $reader]);
        }

    }

    public function customSearch(Request $request)
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $merchants = User::find($id)->merchants->where('enable', '1');    
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->get();
        $branch = $branchOffices->sortBy('id');
        $merchReader = Reader::whereIn('merchant_id', $merchUsr)->get();
        $reader = $merchReader->sortBy('id');
       // dd($merchants);

        //Datos Busqueda
        $daterange = request()->daterange;
        $cbo_reader = request()->readers;
        $cbo_branch = request()->branch;
        $state = request()->state;
        $cbo_merchants = request()->merchant;

         //dd($request);

      
        if (isset($daterange)) {
            $db_range = explode('A', $daterange);
            $from = trim($db_range[0]);
            $to = trim($db_range[1]);

            $trx_data = $this->trxCustomSearch($state, $cbo_reader, $cbo_branch, $cbo_merchants, $db_range);

            return view('transactions.customSearch', ['branch' => $branch,
                'reader' => $reader,
                'trx_data' => $trx_data,
                'merchants' => $merchants]);
        } else {

            return view('transactions.customSearch', ['branch' => $branch,
                'reader' => $reader,
                'merchants' => $merchants]);
        }

    }

    public function trxCustomSearch($state, $cbo_reader, $cbo_branch, $merchantId, $db_range)
    {

        $id = Auth::user()->id;
        $merchUsrId = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('merchant_id');
        $from = trim($db_range[0]);
        $to = trim($db_range[1]);
        $readers = Reader::whereIn('merchant_id', $merchUsrId)->pluck('reader_name');
        $branchs = BranchOffice::whereIn('merchant_id', $merchUsrId)->pluck('branch_name');
       
        $trxState = $state;
        
        if (!isset($cbo_reader)) {
            $cbo_reader = $readers;
        } 
        
        if (!isset($cbo_branch)) {
            $cbo_branch = $branchs;
        } 
        
        if (!isset($merchantId)) {
            $merchantId = $merchUsr;
        }
        
        // dd($cbo_branch);

        if ($state == '0') {

            $trx = Transaction::whereIn('merchant_id', $merchantId)
                ->whereIn('reader_name', $cbo_reader)
                ->whereIn('branch_name', $cbo_branch)
                ->where('trx_result_code', $state)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id', 'desc')->limit(250)->get();

        } else {

            $trx = Transaction::whereIn('merchant_id', $merchantId)
                ->whereIn('reader_name', $cbo_reader)
                ->whereIn('branch_name', $cbo_branch)
                ->where('trx_result_code', '<>', '0')
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id', 'desc')->limit(250)->get();

        }

        return $trx;

    }

} //Fin de la Clase
