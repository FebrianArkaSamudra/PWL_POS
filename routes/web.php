<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
// Route::get('/', [WelcomeController::class, 'index']);

Route::pattern('id','[0-9]+');

Route::get('login',[AuthController::class, 'login'])->name('login');
Route::post('login',[AuthController::class, 'postlogin']);
Route::get('logout',[AuthController::class, 'logout'])->middleware('auth');

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'postregister'])->name('register.post');

Route::middleware(['auth'])->group(function(){
Route::get("/", [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax' ]);
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax' ]);
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax' ]);
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax' ]);
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::middleware(['authorize:ADM,MNG'])->prefix('level')->group(function () {
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/list', [LevelController::class, 'list']);
    Route::get('/create', [LevelController::class, 'create']);
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
    Route::post('/ajax', [LevelController::class, 'store_ajax']);
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax' ]);
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax' ]);
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax' ]);
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax' ]);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/list', [KategoriController::class, 'list']);
    Route::get('/create', [KategoriController::class, 'create']);
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);
    Route::get('/{id}', [KategoriController::class, 'show']);
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax' ]);
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax' ]);
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax' ]);
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax' ]);
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::post('/list', [SupplierController::class, 'list']);
    Route::get('/create', [SupplierController::class, 'create']);
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);
    Route::get('/{id}', [SupplierController::class, 'show']);
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax' ]);
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax' ]);
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax' ]);
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax' ]);
    Route::delete('/{id}', [SupplierController::class, 'destroy']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/list', [BarangController::class, 'list']);
    Route::get('/create', [BarangController::class, 'create']);
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    Route::post('/ajax', [BarangController::class, 'store_ajax']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax' ]);
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax' ]);
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax' ]);
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax' ]);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
    Route::get('/import', [BarangController::class, 'import']); 
    Route::post('/import_ajax', [BarangController::class, 'import_ajax']); 
    Route::get('/export_excel', [BarangController::class, 'export_excel']); 
    Route::get('/export_pdf', [BarangController::class, 'export_pdf']); 
});
    Route::post('/profile/upload', [App\Http\Controllers\ProfileController::class, 'upload'])->name('profile.upload');
});