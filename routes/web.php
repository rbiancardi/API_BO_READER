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

        // Alta de Producto
    Route::get('/new', 'ProductController@index')->name('newProd');
    Route::post('/new', 'ProductController@store')->name('storeNewProduct');

    
    Route::get('/edit', 'ProductController@products')->name('editProducts');

    Route::get('{id}/edit', 'ProductController@productUpdate')->name('ProductEdit');
    
    Route::put('/update', 'ProductController@update')->name('updateProduct');


});

    //Ruta para testing
Route::get('test', 'DashboardController@topVdp');

