<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsOwner;
use App\Http\Controllers\DepositController;

// Halaman publik (landing page dan halaman statis)
Route::get('/', fn() => view('home'));
Route::get('/home', fn() => view('landingpage'));
Route::view('/lokasi', 'lokasi')->name('lokasi');
Route::view('/harga', 'harga')->name('harga');
Route::view('/menu', 'menu')->name('menu');
Route::view('/about', 'about')->name('about');
Route::view('/kontak', 'kontak')->name('kontak');

// Auth routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Pesanan oleh user (guest atau user biasa)
Route::get('/pesan', [PesananController::class, 'create'])->name('pesan.create');
Route::post('/pesan', [PesananController::class, 'store'])->name('pesan.store');


// Route untuk user biasa
Route::prefix('user')->middleware(['auth', IsUser::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    // CRUD pesanan untuk user
    Route::get('/pesanan', [PesananController::class, 'userIndex'])->name('user.pesanan.index');
    Route::get('/pesanan/create', [PesananController::class, 'create'])->name('user.pesanan.create');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('user.pesanan.store');
});

// Route untuk admin
Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // CRUD Pesanan
    Route::get('/pesanan', [PesananController::class, 'adminIndex'])->name('admin.pesanan.index');
    Route::get('/pesanan/create', [PesananController::class, 'adminCreate'])->name('admin.pesanan.create');
    Route::post('/pesanan', [PesananController::class, 'adminStore'])->name('admin.pesanan.store');
    Route::get('/pesanan/{id}/edit', [PesananController::class, 'adminEdit'])->name('admin.pesanan.edit');
    Route::put('/pesanan/{id}', [PesananController::class, 'adminUpdate'])->name('admin.pesanan.update');
    Route::delete('/pesanan/{id}', [PesananController::class, 'adminDestroy'])->name('admin.pesanan.destroy');
    Route::get('/pesanan/{id}/acc', [PesananController::class, 'adminAcc'])->name('admin.pesanan.acc');
    
    // Set Pesanan Selesai dan Kurangi Saldo
    // Route::post('/pesanan/{id}/selesai', [PesananController::class, 'setSelesaiDanKurangiSaldo'])->name('admin.pesanan.selesai');

    // CRUD layanan
    Route::resource('layanan', LayananController::class)->names('admin.layanan');

    // CRUD kategori pakaian
    Route::resource('kategori/pakaian', KategoriController::class)->names('admin.kategori.pakaian');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    // CRUD paket
    Route::get('/paket', [PaketController::class, 'index'])->name('admin.paket.index');
    Route::get('/paket/create', [PaketController::class, 'create'])->name('admin.paket.create');
    Route::post('/paket', [PaketController::class, 'store'])->name('admin.paket.store');
    Route::get('/paket/{id}/edit', [PaketController::class, 'edit'])->name('admin.paket.edit');
    Route::put('/paket/{id}', [PaketController::class, 'update'])->name('admin.paket.update');
    Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('admin.paket.destroy');

    // CRUD pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan.index');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('admin.pelanggan.create');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('admin.pelanggan.store');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('admin.pelanggan.edit');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.destroy');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

    //DEPOSIT
    Route::get('/deposit', [DepositController::class, 'adminindex'])->name('admin.deposit.index');
    Route::post('/deposit/approve/{id}', [DepositController::class, 'adminApprove'])->name('admin.deposit.approve');
    Route::post('/deposit/reject/{id}', [DepositController::class, 'adminReject'])->name('admin.deposit.reject');
    Route::get('/deposit/create', [DepositController::class, 'create'])->name('admin.deposit.create');


});

// Route untuk owner
Route::prefix('owner')->middleware(['auth', IsOwner::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('owner.pelanggan.index');
});

//Route User 
Route::prefix('user')->middleware(['auth', IsUser::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'UserDashboard'])->name('user.dashboard.index');
    Route::get('/pesanan', [DashboardController::class, 'userIndex'])->name('user.pesanan.index');
    Route::post('/pesanan', [PesananController::class, 'UserStore'])->name('user.pesanan.store');
    Route::get('/pesanan/create', [PesananController::class, 'create'])->name('user.pesanan.create');
    Route::get('/transaksi', [DashboardController::class, 'UserTransaksi'])->name('user.transaksi.index');
    // Route::get('/user/transaksi/{id}/edit-pembayaran', [PesananController::class, 'editPembayaran'])->name('user.transaksi.editPembayaran');
    // Route::put('/user/transaksi/{id}/update-pembayaran', [PesananController::class, 'updatePembayaran'])->name('user.transaksi.updatePembayaran');
    // Route::get('/user/transaksi', [DashboardController::class, 'userTransaksiIndex'])->name('user.transaksi.index');
    Route::get('transaksi/{id}/edit', [DashboardController::class, 'editPembayaran'])->name('user.transaksi.edit');
    Route::put('transaksi/{id}', [DashboardController::class, 'updatePembayaran'])->name('user.transaksi.update');
    Route::get('/transaksi', [DashboardController::class, 'userTransaksiIndex'])->name('user.transaksi.index');
    Route::get('/deposit', [DepositController::class, 'index'])->name('user.deposit.index');
    Route::get('/deposit/create', [DepositController::class, 'create'])->name('user.deposit.create');
    Route::post('/deposit', [DepositController::class, 'store'])->name('user.deposit.store');
   
});
    // Route::get('/pelanggan', [PelangganController::class, 'index'])->name('user.pelanggan.index');