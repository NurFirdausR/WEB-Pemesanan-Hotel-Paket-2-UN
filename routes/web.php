<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;

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
//     return view('layouts/master');
// });

Route::get('/reservasi', function () {
    return view('reservasi');
});

    Route::get('/',[TamuController::class,'home'])->name('home');
    Route::get('/kamar',[TamuController::class,'kamar'])->name('kamar');
    Route::get('/fasilitas',[TamuController::class,'fasilitas'])->name('fasilitas');
    Route::get('/detail_kamar/{id}',[TamuController::class,'detail_kamar'])->name('detail_kamar');
    Route::get('/contact',[TamuController::class,'contact'])->name('contact');
    Route::post('/pesan_store',[TamuController::class,'pesan_store'])->name('pesan.store');
    Route::post('/pesan_kamar',[TamuController::class,'pesan_kamar'])->name('pesan_kamar.store');
    // Route::get('/test',[TamuController::class,'test'])->name('test');
    
    Route::get('/pemesanan_step_one',[TamuController::class,'pemesanan_step_one'])->name('pemesanan_step_one');
    Route::post('/pemesanan_step_one/store',[TamuController::class,'pemesanan_step_one_store'])->name('pemesanan_step_one.store');

    Route::get('/pemesanan_step_two',[TamuController::class,'pemesanan_step_two'])->name('pemesanan_step_two');
    Route::post('/pemesanan_step_two/store',[TamuController::class,'pemesanan_step_two_store'])->name('pemesanan_step_two.store');

    Route::get('/pemesanan_step_three',[TamuController::class,'pemesanan_step_three'])->name('pemesanan_step_three');
    Route::post('/pemesanan_step_three/store',[TamuController::class,'pemesanan_step_three_store'])->name('pemesanan_step_three.store');

    Route::get('/pdf/{data}',[TamuController::class,'download_pdf'])->name('download.pdf');
// });
Route::middleware(['guest'])->group(function () { 
    Route::get('/login', function () {
        return view('auth/login');
    });
});
Route::post('/login',[AuthenticatedSessionController::class,'store'])->name('login');
Route::get('/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get("/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);

Route::prefix('admin')->middleware(['auth','role:0','revalidate'])->group(function () {
    Route::get('/dashboard',[AdminController::class,'dashboard_index'])->name('admin.dashboard.index');


    Route::get('/fasilitas',[AdminController::class,'fasilitas_index'])->name('fasilitas.index');
    Route::get('/fasilitas/ajax',[AdminController::class,'fasilitas_ajax'])->name('fasilitas.ajax');
    Route::post('/fasilitas/store',[AdminController::class,'fasilitas_store'])->name('fasilitas.store');
    Route::get('/fasilitas/{id}',[AdminController::class,'fasilitas_edit'])->name('fasilitas.edit');
    Route::put('/fasilitas/update/{id}',[AdminController::class,'fasilitas_update'])->name('fasilitas.update');
    
    Route::get('/kamar',[AdminController::class,'kamar_index'])->name('kamar.index');
    Route::get('/kamar/ajax',[AdminController::class,'kamar_ajax'])->name('kamar.ajax');
    Route::post('/kamar/store',[AdminController::class,'kamar_store'])->name('kamar.store');
    Route::get('/kamar/{id}',[AdminController::class,'kamar_edit'])->name('kamar.edit');
    Route::put('/kamar/update/{id}',[AdminController::class,'kamar_update'])->name('kamar.update');
    Route::delete('/kamar/delete/{id}',[AdminController::class,'kamar_delete'])->name('kamar.delete');
    
    Route::get('/tipe_kamar',[AdminController::class,'tipe_kamar_index'])->name('tipe_kamar.index');
    Route::get('/tipe_kamar/ajax',[AdminController::class,'tipe_kamar_ajax'])->name('tipe_kamar.ajax');
    Route::post('/tipe_kamar/store',[AdminController::class,'tipe_kamar_store'])->name('tipe_kamar.store');
    Route::get('/tipe_kamar/{id}',[AdminController::class,'tipe_kamar_edit'])->name('tipe_kamar.edit');
    Route::put('/tipe_kamar/update/{id}',[AdminController::class,'tipe_kamar_update'])->name('tipe_kamar.update');
    Route::delete('/tipe_kamar/delete/{id}',[AdminController::class,'tipe_kamar_delete'])->name('tipe_kamar.delete');
    
    Route::get('/referral_code',[AdminController::class,'referral_index'])->name('referral.index');
    Route::get('/referral_code/ajax',[AdminController::class,'referral_ajax'])->name('referral.ajax');
    Route::post('/referral_code/store',[AdminController::class,'referral_store'])->name('referral.store');
    Route::get('/referral_code/{id}',[AdminController::class,'referral_edit'])->name('referral.edit');
    Route::put('/referral_code/update/{id}',[AdminController::class,'referral_update'])->name('referral.update');
    Route::delete('/referral_code/delete/{id}',[AdminController::class,'referral_delete'])->name('referral.delete');

    Route::get('/reservasi',[AdminController::class,'reservasi_index'])->name('reservasi.index');
    Route::get('/reservasi/ajax',[AdminController::class,'reservasi_ajax'])->name('reservasi.ajax');

    
    
});

Route::prefix('resepsionis')->middleware(['auth','role:1','revalidate'])->group(function () {
    Route::get('/dashboard',[ResepsionisController::class,'dashboard_index'])->name('resepsionis.dashboard.index');
    Route::get('/reservasi/ajax',[ResepsionisController::class,'reservasi_ajax'])->name('resepsionis.reservasi.ajax');
    Route::put('/reservasi/checkin/{id}',[ResepsionisController::class,'reservasi_check_in'])->name('reservasi.checkin');
    Route::put('/reservasi/checkout/{id}',[ResepsionisController::class,'reservasi_check_out'])->name('reservasi.checkout');
    Route::get('/reservasi/download/{id}',[ResepsionisController::class,'downloadfile'])->name('reservasi.pdf');


    Route::get('/kamar/ajax',[ResepsionisController::class,'kamar_ajax'])->name('resepsionis.kamar.ajax');
    Route::put('/cancel/ajax/{id}',[ResepsionisController::class,'cancel_kamar'])->name('resepsionis.cancel');

});


// require __DIR__.'/auth.php';
// Route::get('/test',[AdminController::class,'test'])->name('test');
