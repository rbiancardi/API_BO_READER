<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\Reader;
use App\BranchSector;
use App\Merchant;
use App\User;
use App\Country;
use App\Province;
use App\County;
use App\Locality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use IlluminateSupportFacadesInput;


class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $branchs = $this->enableBranchs();

        return view('branchoffices.allBranch', ['branchs' => $branchs]);


    }


    public function enableBranchs()
    {
        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)
            ->where('enable', 1)->orderBy('id', 'desc')->get();

        //dd($readers);
        foreach ($branchOffices as $branch) {
            $branch->merchant_id = array_get(Merchant::where('id', $branch->merchant_id)->pluck('merchant_id'),0);
            $branch->branch_country = array_get(Country::where('id',$branch->branch_country)->pluck('name'),0);
            $branch->branch_province   = array_get(Province::where('id',$branch->branch_province)->pluck('name'),0);
            $branch->branch_county = array_get(County::where('id',$branch->branch_county)->pluck('name'),0);
            $branch->branch_localities = array_get(Locality::where('id', $branch->branch_localities)->pluck('name'),0);
                
            
        }

        return $branchOffices;
    }

    public function newBranchCountry()
    {
        $id = Auth::user()->id;
        $merchants = User::find($id)->merchants->where('enable', '1');
        $countries = Country::where('enable', '1')->get();
        return  view('branchoffices.newBranch', ['countries' => $countries,
                                                 'merchants' => $merchants]);

    }

    public function findProvince(Request $request){

        $data=Province::select('name', 'id')->where('countryId', $request->id)->get();
        return response()->json($data);
    }


    public function findCounty(Request $request){

        $prov = Province::find($request->id);
        $counties = $prov->counties;

        return response()->json($counties);
    }

    public function findLocality(Request $request){

        $county = County::find($request->id);
        $localities = $county->localities;

        return response()->json($localities);
    }

    public function test(){

        $county = County::find(51);
        $localities = $county->localities;
        $countryId = $county->id;
        $provinceId = $county->provincies->pluck('id');
        $countryId = $county->countries->pluck('id');

        $localities=Locality::select('name', 'id')->where('countryId', $countryId)
                                                  ->where('provinceId', $provinceId)
                                                  ->where('countyId', $countryId)->get();
              return $county;

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
            'branch_id' => 'required|unique:branchOffices,branch_id|min:6',
            'branch_name' => 'required|unique:branchOffices,branch_name|min:6',
            'merchants' => 'required|min:1',
            'country' => 'required',
            'province' => 'required',
            'county' => 'required',
            'locality' => 'required',

        ]);

        $user =Auth::user();
        $branch = new BranchOffice;
        $branch->branch_id = $request->branch_id;
        $branch->branch_name = $request->branch_name;
        $branch->merchant_id = $request->merchants;
        $branch->branch_country = $request->country;
        $branch->branch_province = $request->province;
        $branch->branch_county = $request->county;
        $branch->branch_localities = $request->locality;
        $branch->user_creator = $user->name . " " . $user->last_name;
        $branch->enable = 1;

        $branch->save();

        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'La Sucursal se Creo Correctamente');

        return redirect('/branchs');

    }

    public function allBranchs()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branchs = BranchOffice::whereIn('merchant_id', $merchUsr)->get();

       // dd($branchs);
                                           
            foreach($branchs as $branch){

                $branch->merchant_id = array_get(Merchant::where('id',  $branch->merchant_id)->pluck('merchant_id'),0);
                $branch->branch_country   =  array_get(Country::where('id',  $branch->branch_country)->pluck('name'),0);
                $branch->branch_province = array_get(Province::where('id', $branch->branch_province)->pluck('name'),0);
                $branch->branch_county = array_get(County::where('id', $branch->branch_county)->pluck('name'),0);
                $branch->branch_localities = array_get(Locality::where('id',  $branch->branch_localities)->pluck('name'),0);
            }


        return view('branchoffices.branchsList', ['branchs' => $branchs]);
    }



    public function showBranchUpdate($id)
    {

        $findBranch = BranchOffice::find($id);
        $merchants = $this->merchants();
        $countries = Country::where('enable', '1')->get();
        $branch = new BranchOffice;

        if($findBranch->enable == 1){
            $enable = 'Habilitado';
        }else{
            $enable = 'Deshabilitado';
        }



        $branch->id = $findBranch->id;
        $branch->branch_id = $findBranch->branch_id;
        $branch->branch_name = $findBranch->branch_name;
        
        $branch->merchant_id = array_get(Merchant::where('id',  $findBranch->merchant_id)->pluck('merchant_id'),0);
        $branch->branch_country   =  array_get(Country::where('id',  $findBranch->branch_country)->pluck('name'),0);
        $branch->branch_province = array_get(Province::where('id', $findBranch->branch_province)->pluck('name'),0);
        $branch->branch_county = array_get(County::where('id', $findBranch->branch_county)->pluck('name'),0);
        $branch->branch_localities = array_get(Locality::where('id',  $findBranch->branch_localities)->pluck('name'),0);
        $branch->enable = $enable;
        
            //dd($branch);

       

        // dd($allSectors);
        return view('branchoffices.branchUpdate', ['branch' => $branch,
            'merchants' => $merchants,
            'countries' => $countries
        ]);

    }


    public function branchUpdate(Request $request)
    {

       // dd($request);
        $request->validate([
            
            'branch_id'     => 'required|min:5',
            'branch_name'   => 'required|min:1',
            'merchants'     => 'required|min:1',
            'country'       => 'required|min:1',
            'province'      => 'required|min:1',
            'county'        => 'required|min:1',
            'locality'      => 'required|min:1',
            

        ]);
                
        $branch = BranchOffice::find($request->branchId);
        $user = Auth::user();

        $branch->branch_id           = $request->branch_id;
        $branch->branch_name         = $request->branch_name;
        $branch->merchant_id         = $request->merchants;
        $branch->enable              = $request->enable;
        $branch->branch_country      = $request->country;
        $branch->branch_province     = $request->province;
        $branch->branch_county       = $request->county;
        $branch->branch_localities   = $request->locality;
        $branch->updated_by          = $user->name . " " . $user->last_name;

        $branch->save();

        $branch_data = BranchOffice::all()->last();


        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'Los Datos de la Sucursal se Actualizaron Correctamente');

        return redirect()->route('branchEdit', ['id' => $request->branchId]);

    }

    


    public function merchants()
    {

        $id = Auth::user()->id;
        $merchants = User::find($id)->merchants->where('enable', '1');

        return $merchants;

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function show(BranchOffice $branchOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchOffice $branchOffice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BranchOffice $branchOffice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(BranchOffice $branchOffice)
    {
        //
    }
}
