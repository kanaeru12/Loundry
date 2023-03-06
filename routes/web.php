<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
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

// Route::get('/', function () {
//     return view('home-page');
// });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'IndexController@index')->name('home-page');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'generateData']);

Route::get('/home/generate-data', 'GenerateDataController@index')->name('generate-data');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

// Route::middleware('auth')->group(function() {
//     Route::resource('basic', BasicController::class);
// });

Route::group(
    [
        'prefix' => 'dashboard',
        'middleware' => ['auth', 'CheckRole:admin']
    ],
    function() {
        Route::resource('basic', BasicController::class);
        Route::resource('outlet', OutletController::class);
        Route::resource('member', MemberController::class);
        Route::resource('paket', PaketController::class);
        Route::resource('transaksi', TransaksiController::class);

        Route::get('/transaksi-list', [App\Http\Controllers\TransaksiController::class, 'index']);

        Route::get('/transaksi/bayar/{kode_invoice}', [App\Http\Controllers\TransaksiController::class,'show_detail']);
        Route::post('/add-paket/{id_transaksi}/{id_paket}', [App\Http\Controllers\TransaksiController::class,'tambahpaket'])->name('tambahpaket');
        
        Route::get('/pilih-paket',[App\Http\Controllers\TransaksiController::class,'selectpaket']);
        Route::delete('/hapus-paket{id}',[App\Http\Controllers\TransaksiController::class,'hapuspaket'])->name('hapus-paket');

        Route::post('/add-diskon/{id}',[App\Http\Controllers\transaksiController::class,'tambahbiaya']);

        Route::get('/laporan-transaksi/{kode_invoice}',[App\Http\Controllers\NotaController::class,'index']);


    }
);

Route::group(
    [
        'prefix' => 'dashboard',
        'middleware' => ['auth', 'CheckRole:kasir']
    ],
    function() {

        Route::resource('member', MemberController::class);

        Route::resource('transaksi', TransaksiController::class);
        Route::get('/transaksi-list', [App\Http\Controllers\TransaksiController::class, 'index']);
        Route::get('/transaksi/bayar/{kode_invoice}', [App\Http\Controllers\TransaksiController::class,'show_detail']);
        Route::post('/add-paket/{id_transaksi}/{id_paket}', [App\Http\Controllers\TransaksiController::class,'tambahpaket'])->name('tambahpaket');
        Route::get('/pilih-paket',[App\Http\Controllers\TransaksiController::class,'selectpaket']);
        Route::delete('/hapus-paket{id}',[App\Http\Controllers\TransaksiController::class,'hapuspaket'])->name('hapus-paket');
        Route::post('/add-diskon/{id}',[App\Http\Controllers\transaksiController::class,'tambahbiaya']);
        Route::get('/laporan-transaksi/{kode_invoice}',[App\Http\Controllers\NotaController::class,'index']);

    }
);
