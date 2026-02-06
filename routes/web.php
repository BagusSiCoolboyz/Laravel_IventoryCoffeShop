<?php

use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanKeluarController;
use App\Http\Controllers\LaporanMasukController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\MasterGoodsController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;



// Route::get('/register',function(){
//     return view('register');
// });

//ALUR LOGIN
Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});
// Route::delete('/persediaan/{id}', [PersediaanController::class, 'destroy']);
// BARANG MASUK
Route::resource('persediaan', PersediaanController::class);

Route::middleware(['auth'],)->group(function () {
    // HALAMAN DEPAN USER DAN ADMIN
    Route::get('/home', [BerandaController::class, 'index'])->name('home');

    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');

    // Route::resource('/home/barang_masuk', BarangmasukController::class);
    Route::controller(BarangMasukController::class)->prefix('barang_masuk')->group(function () {
        Route::get('', 'index')->name('barang_masuk');
        Route::get('tambah', 'tambah')->name('barang_masuk.tambah');
        Route::post('tambah', 'simpan')->name('barang_masuk.tambah.simpan');
        Route::get('edit/{id}', 'edit')->name('barang_masuk.edit');
        Route::post('edit/{id}', 'update')->name('barang_masuk.tambah.update');
        Route::delete('hapus/{id}', 'hapus')->name('barang_masuk.hapus');
        Route::get('/filter-by-date', 'filterByDate')->name('filter-by-date');
        Route::get('/logout', [SesiController::class, 'logout']);
    });

    Route::get("barang_masuk/create", function () {
        return view('/halaman/barang-masuk/create', [
            "title" => "Barang Masuk",
            "header" =>  "Barang Masuk",
            "judul" => "DATA BAHAN BAKU"
        ]);
    })->name('barang_masuk/create');



    // BARANG KELUAR
    // Route::get('barang_keluar', function () {
    //     return view('/halaman/barang_keluar',[
    //         "title" => "Barang Keluar",
    //         "header" =>  "Barang Keluar",
    //         "judul" => "DATA BAHAN BAKU"
    //     ]);
    // })->name('barang_keluar');

    Route::controller(BarangKeluarController::class)->prefix('barang_keluar')->group(function () {
        Route::get('', 'index')->name('barang_keluar');
        Route::get('tambah', 'tambah')->name('barang_keluar.tambah');
        Route::post('tambah', 'simpan')->name('barang_keluar.tambah.simpan');
        Route::get('edit/{id}', 'edit')->name('barang_keluar.edit');
        Route::post('edit/{id}', 'update')->name('barang_keluar.tambah.update');
        Route::delete('hapus/{id}', 'hapus')->name('barang_keluar.hapus');
        Route::get('/logout', [SesiController::class, 'logout']);
    });

    // Route::get("barang_keluar/create", function () {
    //     return view('/halaman/barang-keluar/create', [
    //         "title" => "Barang Keluar",
    //         "header" =>  "Barang Keluar",
    //         "judul" => "DATA BAHAN BAKU"
    //     ]);
    // })->name('barang_keluar/create');

    // Route untuk halaman laporan yang hanya dapat diakses oleh admin
    Route::middleware(['admin'])->group(function () {

        Route::controller(LaporanMasukController::class)->prefix('laporan-masuk')->group(function () {
            Route::get('', 'index')->name('laporan-masuk');
            // Route::get('tambah', 'tambah')->name('laporan-masuk.tambah');
            // Route::post('tambah', 'simpan')->name('laporan-masuk.tambah.simpan');
            // Route::get('edit/{id}', 'edit')->name('laporan-masuk.edit');
            // Route::post('edit/{id}', 'update')->name('laporan-masuk.tambah.update');
            // Route::delete('hapus/{id}', 'hapus')->name('laporan-masuk.hapus');
        });

        // Route::get('laporan-masuk', function () {
        //     return view('/halaman/laporan/masuk',[
        //         "title" => "Laporan Masuk",
        //         "header" =>  "Laporan Masuk",
        //         "judul" => "DATA BAHAN BAKU"
        //     ]);
        // })->name('laporan-masuk');
        Route::controller(LaporanKeluarController::class)->prefix('laporan-keluar')->group(function () {
            Route::get('', 'index')->name('laporan-keluar');
            // Route::get('tambah', 'tambah')->name('laporan-keluar.tambah');
            // Route::post('tambah', 'simpan')->name('laporan-keluar.tambah.simpan');
            // Route::get('edit/{id}', 'edit')->name('laporan-keluar.edit');
            // Route::post('edit/{id}', 'update')->name('laporan-keluar.tambah.update');
            // Route::delete('hapus/{id}', 'hapus')->name('laporan-keluar.hapus');
        });
        // Route::get('laporan-keluar', function () {
        //     return view('/halaman/laporan/keluar',[
        //         "title" => "Laporan Keluar",
        //         "header" =>  "Laporan Keluar",
        //         "judul" => "DATA BAHAN BAKU"
        //     ]);
        // })->name('laporan-keluar');

        Route::get('laporan-persediaan', function () {
            return view('/halaman/laporan/stok', [
                "title" => "Laporan Persediaan",
                "header" =>  "Laporan Persediaan",
                "judul" => "DATA BAHAN BAKU"
            ]);
        })->name('laporan-persediaan');

        //Route Master Data
        Route::controller(MasterGoodsController::class)->prefix('master-data')->group(function () {
            Route::get('/', [MasterGoodsController::class, 'list'])->name('master-data');
            Route::post('/store', [MasterGoodsController::class, 'store'])->name('master-data.insert');
            Route::get('/{id}', [MasterGoodsController::class, 'showData'])->name('master-data.show');
            Route::put('/update/{id}', [MasterGoodsController::class, 'updateData'])->name('master-data.update');
        });
    });

    Route::get('/logout', [SesiController::class, 'logout']);
});
