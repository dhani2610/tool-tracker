<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PinjamanBarangController;
use App\Http\Controllers\RegisterController;
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
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');


Route::get('cari-alat', [RegisterController::class, 'cari'])->name('cari-alat');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('loginPost2', [UserController::class, 'loginPost2'])->name('loginPost2');
Route::post('loginPostAdmin', [UserController::class, 'loginPostAdmin'])->name('loginPostAdmin');

Route::middleware('auth:web')->group(function () {
    // Dashboard admin
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    Route::get('approval-list', [ApprovalRegisterController::class, 'notifikasi'])->name('approval-list');
    Route::post('approve-register/{id}', [ApprovalRegisterController::class, 'approval'])->name('approve-register');
    Route::post('not-approve-register/{id}', [ApprovalRegisterController::class, 'notApprove'])->name('not-approve-register');
    // Dashboard umum
    
    Route::get('alat-list', [BarangController::class, 'index'])->name('alat-list');
    Route::get('alat-list-umum', [BarangController::class, 'indexUmum'])->name('alat-list-umum');
    Route::get('alat-create', [BarangController::class, 'create'])->name('alat-create');
    Route::post('alat-store', [BarangController::class, 'store'])->name('alat-store');
    Route::get('alat-edit/{id}', [BarangController::class, 'edit'])->name('alat-edit');
    Route::post('alat-update/{id}', [BarangController::class, 'update'])->name('alat-update');
    Route::get('alat-destroy/{id}', [BarangController::class, 'destroy'])->name('alat-destroy');
    
    Route::get('approve-alat', [BarangController::class, 'listApproveAlat'])->name('approve-alat');
    Route::get('set-status-setuju-alat/{id}', [BarangController::class, 'setSetuju'])->name('set-status-setuju-alat');
    Route::get('set-status-tidak-setuju-alat/{id}', [BarangController::class, 'setTidakSetuju'])->name('set-status-tidak-setuju-alat');


    Route::post('pinjam', [PinjamanBarangController::class, 'pinjam'])->name('pinjam');
    Route::get('request-peminjaman-my-alat', [PinjamanBarangController::class, 'listReqPinjamMyAlat'])->name('request-peminjaman-my-alat');
    Route::get('setuju-request-peminjaman-my-alat/{id}', [PinjamanBarangController::class, 'setSetuju'])->name('setuju-request-peminjaman-my-alat');
    Route::get('tidak-setuju-request-peminjaman-my-alat/{id}', [PinjamanBarangController::class, 'setTidakSetuju'])->name('tidak-setuju-request-peminjaman-my-alat');
    Route::get('peminjaman-alat', [PinjamanBarangController::class, 'pinjamAlat'])->name('peminjaman-alat');
    Route::get('hapus-peminjaman-alat/{id}', [PinjamanBarangController::class, 'hapusPinjam'])->name('hapus-peminjaman-alat');
    Route::post('edit-peminjaman-alat/{id}', [PinjamanBarangController::class, 'editpinjam'])->name('edit-peminjaman-alat');
    
    Route::post('store-pengembalian-alat/{id}', [PinjamanBarangController::class, 'storePengembalian'])->name('store-pengembalian-alat');
    Route::get('req-pengembalian-alat', [PinjamanBarangController::class, 'reqPengembalianMyAlat'])->name('req-pengembalian-alat');
    Route::get('setuju-request-pengembalian-my-alat/{id}', [PinjamanBarangController::class, 'setSetujuPengembalian'])->name('setuju-request-pengembalian-my-alat');
    Route::get('tidak-setuju-request-pengembalian-my-alat/{id}', [PinjamanBarangController::class, 'setTidakSetujuPengembalian'])->name('tidak-setuju-request-pengembalian-my-alat');
    Route::get('pengembalian-list', [PinjamanBarangController::class, 'pengembalianList'])->name('pengembalian-list');
    Route::post('edit-pengembalian-alat/{id}', [PinjamanBarangController::class, 'editPengembalian'])->name('edit-pengembalian-alat');
    
    Route::get('ba-peminjaman/{id}', [PinjamanBarangController::class, 'BApeminjaman'])->name('ba-peminjaman');
    Route::get('ba-pengembalian/{id}', [PinjamanBarangController::class, 'BApengembalian'])->name('ba-pengembalian');

    Route::get('history-barang/{id}', [PinjamanBarangController::class, 'historyAlat'])->name('history-barang');

    Route::get('get/map', [DashboardController::class, 'getMap'])->name('get.map');
    // Master Data
     Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    // Departement
    Route::resource('departements', DepartementController::class);

    // Users
    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::resource('users', UserController::class)->except([
        'show'
    ]);;

    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');

    
    // History Log
    Route::resource('history-log', HistoryLogController::class)->except([
        'show', 'create', 'store', 'edit', 'update'
    ]);;

    // profilr edit
    Route::resource('profile', ProfileController::class)->except([
        'show','create', 'store'
    ]);;
    Route::patch('change-password-profile', [ProfileController::class, 'changePassword'])->name('profile.change-password');


});

