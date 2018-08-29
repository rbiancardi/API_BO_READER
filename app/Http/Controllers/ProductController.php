<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\BranchSector;
use App\Currency;
use App\MerchantProduct;
use App\Product;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = $this->getCurrencies();
        $branchs = $this->branchs();
        $merchants = $this->merchants();
        $sectors = $this->sectors();

        return view('products.newProd', ['currencies' => $currencies,
            'branchs' => $branchs,
            'sectors' => $sectors,
            'merchants' => $merchants,
        ]);

    }

    public function store(Request $request)
    {
        // $this->validNewProduct($request);

        $request->validate([
            'barcode' => 'required||numeric',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:3',
            'merchants' => 'required|array|min:1',
            'currency' => 'required|array|min:1',
            'sectors' => 'required|array|min:1',
            'branchs' => 'required|array|min:1',

        ]);

        $product = new Product;
        $user = Auth::user();

        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->enable = '1';
        $product->user_creator = $user->name . " " . $user->last_name;

        $product->save();

        //Para que el sync() funcione y sincronice con la pivot hay que poner   'strict' => false, en config=>database.php
        /*sync(, false) para agregar relaciones, en true borra las existentes para
        el producto que esta ingresando y guarda las nuevas relaciones en la pivot*/

        $product->merchants()->sync($request->merchants, false);
        $product->currencies()->sync($request->currency, false);
        $product->branchSectors()->sync($request->sectors, false);
        $product->branchOffices()->sync($request->branchs, false);

        $product_data = Product::all()->last();
        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'El Producto se Creo Correctamente');

        return view('products.storedProduct', ['product_data' => $product_data]);
    }

    public function getCurrencies()
    {

        $currencies = Currency::all()->where('enable', '1');
        return $currencies;

    }

    public function branchs()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->get();
        $branch = $branchOffices->sortBy('id');

        return $branch;

    }

    public function products()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $pivotProducts = MerchantProduct::whereIn('merchant_id', $merchUsr)->pluck('product_id');
        $products = Product::whereIn('id', $pivotProducts)->orderBy('id', 'desc')->get();
        // dd($products);
        return view('products.productsList', ['products' => $products]);

    }

    public function enableProducts()
    {

        $id = Auth::user()->id;
        $merchUsr = User::find($id)->merchants->where('enable', '1')->pluck('id');
        $pivotProducts = MerchantProduct::whereIn('merchant_id', $merchUsr)->pluck('product_id');
        $products = Product::whereIn('id', $pivotProducts)
                           ->where('enable', 1)->orderBy('id', 'desc')->get();
        // dd($products); 1546153029431
        return view('products.allProducts', ['products' => $products]);

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
        
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->get();
        $branchID = $branchOffices->pluck('id');
        
        $sectorsId = DB::table('branchOffices_branchSectors')->select('branchSectors_id')->distinct()
                         ->whereIn('branchOffices_Id', $branchID)->pluck('branchSectors_id');
                          //dd($sectorsId);     
        $sectors = DB::table('branchSectors')
                      ->whereIn('id', $sectorsId)->get();
                                      


       // dd($merchUsr);
        return $sectors;

    }

    public function show($id)
    {

        $findProd = Product::find($id);

        $product = array('barcode' => $findProd->barcode,
            'description' => $findProd->description,
            'currency' => $findProd->currencies,
            'price' => $findProd->price,
            'merchants' => $findProd->merchants,
            'branchOffices' => $findProd->branchOffices,
            'branchSectors' => $findProd->branchSectors,
            'enable' => $findProd->enable,
        );

        return $product;

    }

    public function showProductUpdate($id)
    {

        $findProd = Product::find($id);
        $allSectors = $this->sectors();
        $allBranchs = $this->branchs();
        $allCurrencies = $this->getCurrencies();
        $allMerchants = $this->merchants();

        if($findProd->enable == 1){
            $enable = 'Habilitado';
        }else{
            $enable = 'Deshabilitado';
        }


        $product = (object) array('barcode' => $findProd->barcode,
            'description' => $findProd->description,
            'price' => $findProd->price,
            'id' => $findProd->id,
            'enable' => $enable);
        $currency = $findProd->currencies;
        $merchants = $findProd->merchants;
        $branchOffices = $findProd->branchOffices;
        $branchSectors = $findProd->branchSectors;

        // dd($allSectors);
        return view('products.prodUpdate', ['product' => $product,
            'merchants' => $merchants,
            'branchOffices' => $branchOffices,
            'branchSectors' => $branchSectors,
            'currencies' => $currency,
            'allSectors' => $allSectors,
            'allBranchs' => $allBranchs,
            'allCurrencies' => $allCurrencies,
            'allMerchants' => $allMerchants,
        ]);

    }

    public function ProductUpdate(Request $request)
    {

        $request->validate([
            'barcode' => 'required|numeric',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:3',
            'merchants' => 'required|array|min:1',
            'currency' => 'required|array|min:1',
            'sectors' => 'required|array|min:1',
            'branchs' => 'required|array|min:1',

        ]);

        $product = Product::find($request->prodId);
        $user = Auth::user();

        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->enable = $request->enable;
        $product->updated_by = $user->name . " " . $user->last_name;

        $product->save();

        //Para que el sync() funcione y sincronice con la pivot hay que poner   'strict' => false, en config=>database.php
        /*sync(, false) para agregar relaciones, en true borra las existentes para
        el producto que esta ingresando y guarda las nuevas relaciones en la pivot*/

        $product->merchants()->sync($request->merchants, true);
        $product->currencies()->sync($request->currency, true);
        $product->branchSectors()->sync($request->sectors, true);
        $product->branchOffices()->sync($request->branchs, true);

        $product_data = Product::all()->last();
        //Key que lee el partial Success + Mensaje a mostrar con el Session::get
        $request->session()->flash('success', 'El Producto se Actualizo Correctamente');

        return redirect()->route('ProductEdit', ['id' => $request->prodId]);

    }

    

}
