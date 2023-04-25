<?php

use Illuminate\Support\Facades\Route;

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
    return view('Auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\AcheterController::class, 'sellProductBestLeast']);

Route::get('/sell-prod-today', [App\Http\Controllers\AcheterController::class, 'sellListToday']);

Route::get('/sell-prod-week', [App\Http\Controllers\AcheterController::class, 'sellListWeek']);

Route::get('/sell-prod-month', [App\Http\Controllers\AcheterController::class, 'sellListMonth']);

Route::resource('categories', App\Http\Controllers\CategorieController::class);


Route::post('/sell', [App\Http\Controllers\AcheterController::class, 'sell'])->name('sell');


Route::post('/prix/{data}', [App\Http\Controllers\AcheterController::class, 'prix'])->name('prix');


Route::resource('lots', App\Http\Controllers\LotController::class);


Route::resource('produits', App\Http\Controllers\ProduitController::class);


Route::resource('acheters', App\Http\Controllers\AcheterController::class);

Route::get('/produit-search', [App\Http\Controllers\ProduitController::class, 'searchProduit'])->name('produit-search');

Route::get('/lot-search', [App\Http\Controllers\LotController::class, 'searchLot'])->name('lot-search');

Route::get('/category-search', [App\Http\Controllers\CategorieController::class, 'searchCategory'])->name('category-search');

Route::get('/produit-vendu-search', [App\Http\Controllers\AcheterController::class, 'searchProd'])->name('produit-vendu-search');

Route::get('/products/{date}', [App\Http\Controllers\AcheterController::class, 'showProducts']);

Route::get('/download-pdf', [App\Http\Controllers\ProduitController::class, 'downloadPDF'])->name('download-pdf');

//Route::get('/products/{date}', 'ProductController@showProducts');
