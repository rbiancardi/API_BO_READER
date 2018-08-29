<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\BranchSector;
use App\Merchant;
use App\User;
use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = $this->getBranchSectors();

        return view('branchSectors.allSectors', ['sectors' => $sectors]);
    }


    public function getBranchSectors()
    {
        $branchOffices = $this->branchs();
        $branchID = $branchOffices->pluck('id');
       // dd($branchID);
        $sectorsId = DB::table('branchOffices_branchSectors')->select('branchSectors_id')->distinct()
                        ->whereIn('branchOffices_Id', $branchID)->pluck('branchSectors_id');
                   //dd($sectorsId);     
        $sectors = DB::table('branchSectors')
                    ->whereIn('id', $sectorsId)->get();

        //dd($sectors);
        return $sectors;
    }

    public function allSectors(){

        $sectors = $this->getBranchSectors();
        
        return view('branchSectors.sectorList', ['sectors' => $sectors ]);

    }

    public function showSectorUpdate($id){


        $findSector = BranchSector::find($id);

        $sector = new BranchSector;

        if($findSector->enable == 1){
            $enable = 'Habilitado';
        }else{
            $enable = 'Deshabilitado';
        }



        $sector->id = $findSector->id;
        $sector->sector_name = $findSector->sector_name;
        $sector->sector_description = $findSector->sector_description;
        $sector->enable = $enable;
        $branchOffices = $findSector->branchOffices;
        $allBranchs = $this->branchs();
       
         //dd($sector);
        return view('branchSectors.sectorUpdate', ['sector' => $sector,
                                                   'branchOffices' => $branchOffices,
                                                   'allBranchs' => $allBranchs]);
    }

    public function sectorUpdate (Request $request){

       // dd($request);
        $request->validate([
            'sectorName' => 'required|min:1',
            'sector_description' => 'required|min:10',
            'allbranchs' => 'required|array|min:1',

        ]);

        $sector = BranchSector::find($request->sector_id);
        $user = Auth::user();

        $sector->sector_name = $request->sectorName;
        $sector->sector_description = $request->sector_description;
        $sector->enable = $request->enable;
        $sector->updated_by = $user->name . " " . $user->last_name;

        $sector->save();

        //Para que el sync() funcione y sincronice con la pivot hay que poner   'strict' => false, en config=>database.php
        /*sync(, false) para agregar relaciones, en true borra las existentes para
        el producto que esta ingresando y guarda las nuevas relaciones en la pivot*/

        $sector->branchOffices()->sync($request->allbranchs, true);

        $sector_data = BranchSector::all()->last();
        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'El Sector se Actualizo Correctamente');

        return redirect()->route('sectorEdit', ['id' => $request->sector_id]);

    }


    public function newBranchSector()
    {
            $branchs = $this->branchs();

    
        return view('branchSectors.newSector', ['branchs' => $branchs ]);

    }

    public function branchs()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->get();
        $branch = $branchOffices->sortBy('id');

        return $branch;

    }

   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'sector_name' => 'required',
            'sector_description' => 'required|min:10',
            'merchants' => 'required|min:1',
            'branchs' => 'required|array|min:1',

        ]);

       
        $user = Auth::user();
      
       //  dd($request);
       
        $sector = new BranchSector;
              $sector->sector_name = $request->sector_name;
              $sector->sector_description = $request->sector_description;
              $sector->enable = '1';
              $sector->user_creator = $user->name . " " . $user->last_name;

              //dd($request);
            $sector->save();

            $sector->branchOffices()->sync($request->branchs, false);
        //Para que el sync() funcione y sincronice con la pivot hay que poner   'strict' => false, en config=>database.php
        /*sync(, false) para agregar relaciones, en true borra las existentes para
        el producto que esta ingresando y guarda las nuevas relaciones en la pivot*/

        
        //$sector->merchants()->sync($request->merchants, false);

        $last_sector = BranchSector::all()->pluck('id')->last();
       
        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'El Sector se Creo Correctamente');

        return redirect('/sectors');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BranchSector  $branchSector
     * @return \Illuminate\Http\Response
     */
    public function show(BranchSector $branchSector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BranchSector  $branchSector
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchSector $branchSector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BranchSector  $branchSector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BranchSector $branchSector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BranchSector  $branchSector
     * @return \Illuminate\Http\Response
     */
    public function destroy(BranchSector $branchSector)
    {
        //
    }
}
