<?php

namespace App\Http\Controllers;

use App\Reader;
use App\BranchOffice;
use App\BranchSector;
use App\Merchant;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = $this->enableReaders();




        return view('readers.allReaders', ['readers' => $readers]);
    }



    public function enableReaders()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $readers = Reader::whereIn('merchant_id', $merchUsr)
            ->where('enable', 1)->orderBy('id', 'desc')->get();

        //dd($readers);
        foreach ($readers as $reader) {
            
            $reader->merchant_id = array_get(Merchant::where('id', $reader->merchant_id)->pluck('merchant_id'),0);
            $reader->branch_id =  array_get(BranchOffice::where('id', $reader->branch_id)->pluck('branch_name'),0);
            $reader->branchSector_id = array_get(BranchSector::where('id', $reader->branchSector_id)->pluck('sector_name'),0);
//dd($reader->branchSector_id);
        }


    return $readers;

}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newVDP()
    {
        $branchs = $this->branchs();
        $merchants = $this->merchants();
        $sectors = $this->sectors();


        return view('readers.newVdp', ['branchs' => $branchs,
                                       'sectors' => $sectors,
                                       'merchants' => $merchants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            
            'reader_name' => 'required|min:5|unique:readers,reader_name',
            'merchant_id' => 'required|min:1',
            'branch_id' => 'required|min:1',
            'branchSector_id' => 'required|min:1',
            'reader_ip' => 'required|min:7',

        ]);

        
        $vdp = new Reader;
        $user = Auth::user();

        $vdp->reader_name = $request['reader_name'];
        $vdp->merchant_id = $request['merchant_id'];
        $vdp->branch_id = $request['branch_id'];
        $vdp->branchSector_id = $request['branchSector_id'];
        $vdp->reader_ip = $request['reader_ip'];
        $vdp->enable = 1;
        $vdp->created_by =  $user->name . " " . $user->last_name;

        $vdp->save();

        $vdp_data = Reader::all()->last();

        $vdp_data->merchant_id = array_get(Merchant::where('id', $vdp_data->merchant_id)->pluck('merchant_id'),0);
        $vdp_data->branch_id =  array_get(BranchOffice::where('id', $vdp_data->branch_id)->pluck('branch_name'),0);
        $vdp_data->branchSector_id = array_get(BranchSector::where('id', $vdp_data->branchSector_id)->pluck('sector_name'),0);

        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'El Verificador de Precios se Creo Correctamente');

        return view('readers.storedVdp', ['vdp_data' => $vdp_data]);


    }


    public function branchs()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->get();
        $branch = $branchOffices->sortBy('id');

        return $branch;

    }


    public function merchants()
    {

        $id = Auth::user()->id;
        $merchants = User::find($id)->merchants->where('enable', '1');

        return $merchants;

    }

    public function sectors()
    {
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->pluck('id');
         
        $branchID = $branchOffices;
                
        $sectorsId = DB::table('branchOffices_branchSectors')->select('branchSectors_id')->distinct()
                        ->whereIn('branchOffices_Id', $branchID)->pluck('branchSectors_id');
        $sectors = DB::table('branchSectors')
                    ->whereIn('id', $sectorsId)->get();

      
        return $sectors;

    }

    public function readers()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $readers = Reader::whereIn('merchant_id', $merchUsr)->get();

            foreach($readers as $reader){

                $reader->merchant_id = array_get(Merchant::where('id', $reader->merchant_id)->pluck('merchant_id'),0);
                $reader->branch_id =  array_get(BranchOffice::where('id', $reader->branch_id)->pluck('branch_name'),0);
                $reader->branchSector_id = array_get(BranchSector::where('id', $reader->branchSector_id)->pluck('sector_name'),0);
            }


        return view('readers.readersList', ['readers' => $readers]);

    }



    public function showReaderUpdate($id)
    {

        $findReader = Reader::find($id);
        $allSectors = $this->sectors();
        $allBranchs = $this->branchs();
        $allMerchants = $this->merchants();
        $vdp = new Reader;

        if($findReader->enable == 1){
            $enable = 'Habilitado';
        }else{
            $enable = 'Deshabilitado';
        }



        $vdp->reader_name = $findReader->reader_name;
        $vdp->merchant_id = $findReader->merchant_id;
        $vdp->branch_id = $findReader->branch_id;
        $vdp->branchSector_id = $findReader->branchSector_id;
        $vdp->reader_ip = $findReader->reader_ip;
        $vdp->id = $findReader->id;
        $vdp->enable = $enable;
        $vdp->vdpMerchantName = array_get(Merchant::where('id', $findReader->merchant_id)->pluck('merchant_id'),0);
        $vdp->vdpBranchName =   array_get(BranchOffice::where('id', $findReader->branch_id)->pluck('branch_name'),0);
        $vdp->vdpSectorName =   array_get(BranchSector::where('id', $findReader->branchSector_id)->pluck('sector_name'),0);
        
            //dd($vdp);

       

        // dd($allSectors);
        return view('readers.readerUpdate', ['vdp' => $vdp,
            'allSectors' => $allSectors,
            'allBranchs' => $allBranchs,
            'allMerchants' => $allMerchants,
        ]);

    }

    
    public function ReaderUpdate(Request $request)
    {

        $request->validate([
            
            'reader_name' => 'required|min:5',
            'merchant_id' => 'required|min:1',
            'branch_id' => 'required|min:1',
            'branchSector_id' => 'required|min:1',
            

        ]);

        
        $vdp = Reader::find($request->readerId);
        $user = Auth::user();

        $vdp->reader_name     = $request->reader_name;
        $vdp->merchant_id     = $request->merchant_id;
        $vdp->branch_id       = $request->branch_id;
        $vdp->branchSector_id = $request->branchSector_id;
        $vdp->reader_ip       = $request->reader_ip;
        $vdp->enable          = $request->enable;
        $vdp->updated_by      = $user->name . " " . $user->last_name;

        $vdp->save();

        $vdp_data = Reader::all()->last();


        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'Los Datos del Verificador se Actualizaron Correctamente');

        return redirect()->route('ReaderEdit', ['id' => $request->readerId]);

    }
}
