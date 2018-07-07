<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Currency;
use App\BranchOffice;
use App\BranchSector;
use App\MerchantProduct;
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
            'barcode'     => 'required||numeric',
            'description' => 'required|min:10',
            'price'       => 'required|numeric|min:3',
            'merchants'   => 'required|array|min:1',
            'currency'    => 'required|array|min:1',
            'sectors'     => 'required|array|min:1',
            'branchs'     => 'required|array|min:1'

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
           
        return view ('products.storedProduct',['product_data' => $product_data]);
    }

    public function getCurrencies()
    {

        $currencies = Currency::all()->where('enable', '1');
        return $currencies;

    }

    public function branchs()
    {

        $id = Auth::user()->pluck('id');
        $merchUsr = User::find($id[0])->merchants->where('enable', '1')->pluck('id');
        $branchOffices = BranchOffice::whereIn('merchant_id', $merchUsr)->get();
        $branch = $branchOffices->sortBy('id');

        return $branch;

    }


    public function products()
    {

        $id = Auth::user()->pluck('id');
        $merchUsr = User::find($id[0])->merchants->where('enable', '1')->pluck('id');
        $pivotProducts = MerchantProduct::whereIn('merchant_id', $merchUsr)->pluck('product_id');
        $products = Product::whereIn('id', $pivotProducts)->orderBy('id', 'desc')->get();
       // dd($products);
        return view ('products.productsList',[ 'products' => $products]);

    }

    public function merchants()
    {

        $id = Auth::user()->pluck('id');
        $merchants = User::find($id[0])->merchants->where('enable', '1');

        return $merchants;

    }

    public function sectors()
    {

        $sectors = BranchSector::all()->where('enable', '1');
        return $sectors;

    }


    public function show($id){

        $findProd = Product::find($id);

                    $product = array('barcode' => $findProd->barcode,
                    'description' => $findProd->description,
                    'currency' => $findProd->currencies,
                    'price' => $findProd->price,
                    'merchants' => $findProd->merchants,
                    'branchOffices' => $findProd->branchOffices,
                    'branchSectors' => $findProd->branchSectors
                    );  
          
        return $product;

    }

    public function productUpdate($id){

        $findProd = Product::find($id);
       
        $product = array('barcode' => $findProd->barcode,
                         'description' => $findProd->description,
                          'price' => $findProd->price); 
        $currency = $findProd->currencies;                          
        $merchants = $findProd->merchants;
        $branchOffices = $findProd->branchOffices;
        $branchSectors = $findProd->branchSectors;
                          
                         //dd($currency);
           return  view('products.prodUpdate',['product' => $product,
                                               'merchants' => $merchants,
                                               'branchOffices' => $branchOffices,
                                               'branchSectors' => $branchSectors,
                                               'currencies' => $currency
           ]);

    }

    

}
