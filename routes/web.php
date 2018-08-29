<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('prefix' => 'dashboard'
    , 'middleware' => 'auth'), function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');
    
});


Route::group(array('prefix' => 'transactions'
	, 'middleware' => 'auth'), function () {

        //hom transactions
    Route::get('/', 'TransactionController@index')->name('transactions');
    Route::post('/', 'TransactionController@index')->name('trxquery');

    // Transactions Search ID
    Route::get('/id', function () { return view('transactions.searchId');})->name('trxId');
    Route::post('/id', 'TransactionController@trxId');

    // Transactions Search Barcode/Branch
    Route::get('/reader', 'TransactionController@searchTrxReaderBranch')->name('searchTrxReaderBranch');
    Route::post('/reader', 'TransactionController@searchTrxReaderBranch');

    // Transactions Custom Search 
    Route::get('/custom', 'TransactionController@customSearch')->name('customSearch');
    Route::post('/custom', 'TransactionController@customSearch');

});

Route::group(array('prefix' => 'products'
	, 'middleware' => 'auth'), function () {

    Route::get('/', 'ProductController@enableProducts')->name('products');

        // Alta de Producto
    Route::get('/new', 'ProductController@index')->name('newProd');
    Route::post('/new', 'ProductController@store')->name('storeNewProduct');

      // Alta de Producto
    
    Route::get('/edit', 'ProductController@products')->name('editProducts');
    Route::get('{id}/edit', 'ProductController@showProductUpdate')->name('ProductEdit');
    Route::put('/update', 'ProductController@ProductUpdate')->name('updateProduct');

});


Route::group(array('prefix' => 'readers'
	, 'middleware' => 'auth'), function () {

    Route::get('/', 'ReaderController@index')->name('readers');

        // Alta de Lectores

    Route::get('/new',  'ReaderController@newVDP')->name('newVDP');
    Route::post('/new', 'ReaderController@store')->name('storeNewVDP');

        //Editar Lectores   

    Route::get('/edit', 'ReaderController@readers')->name('editReaders');
    Route::get('{id}/edit', 'ReaderController@showReaderUpdate')->name('ReaderEdit');
    Route::put('/update', 'ReaderController@ReaderUpdate')->name('updateReader');

});


Route::group(array('prefix' => 'branchs'
	, 'middleware' => 'auth'), function () {
        
    Route::get('/', 'BranchOfficeController@index')->name('branchs');
   
    //Alta de Sucursal
    Route::get('/newBranch', 'BranchOfficeController@newBranchCountry')->name('newBranch');
    Route::post('/newBranch', 'BranchOfficeController@store')->name('storeNewBranch');

    //Editar Sucursal

    Route::get('/edit', 'BranchOfficeController@allBranchs')->name('editBranchs');
    Route::get('{id}/edit', 'BranchOfficeController@showBranchUpdate')->name('branchEdit');
    Route::put('/update', 'BranchOfficeController@branchUpdate')->name('branchUpdate');



    //Dependent Select
    Route::get('/findProvince', 'BranchOfficeController@findProvince')->name('findProvince');
    Route::get('/findCounty', 'BranchOfficeController@findCounty')->name('findCounty');
    Route::get('/findLocality', 'BranchOfficeController@findLocality')->name('findLocality');
});


Route::group(array('prefix' => 'sectors'
	, 'middleware' => 'auth'), function () {
        
    Route::get('/', 'BranchSectorController@index')->name('sectors');
   
    //Alta de Sector
  
    Route::get('/newBranchSector', 'BranchSectorController@newBranchSector')->name('newSector');
    Route::post('/newBranchSecotr', 'BranchSectorController@store')->name('storeNewSector');


    //Editar Sector

    Route::get('/edit', 'BranchSectorController@allSectors')->name('editSector');
    Route::get('{id}/edit', 'BranchSectorController@showSectorUpdate')->name('sectorEdit');
    Route::put('/update', 'BranchSectorController@sectorUpdate')->name('sectorUpdate');    

});


Route::group(array('prefix' => 'customers'
	, 'middleware' => 'auth'), function () {
        
    Route::get('/', 'BranchSectorController@index')->name('sectors');
   
    //Alta de Sector
  
    Route::get('/newBranchSector', 'BranchSectorController@newBranchSector')->name('newSector');
    Route::post('/newBranchSecotr', 'BranchSectorController@store')->name('storeNewSector');


    //Editar Sector

    Route::get('/edit', 'BranchSectorController@allSectors')->name('editSector');
    Route::get('{id}/edit', 'BranchSectorController@showSectorUpdate')->name('sectorEdit');
    Route::put('/update', 'BranchSectorController@sectorUpdate')->name('sectorUpdate');    

});


//Ruta para testing
Route::get('test', 'BranchOfficeController@test');

