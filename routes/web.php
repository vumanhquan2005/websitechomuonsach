<?php
use Illuminate\Support\Facades\Route;


// auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// auth


// client
use App\Http\Controllers\Client\HomeController;
// client


// admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BorrowRecordController;
// admin


// auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// auth


// client 
Route::get('/', [HomeController::class, 'index'])->name('client.home');
// client


// admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'store', 'destroy']);
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('book', \App\Http\Controllers\Admin\BookController::class); // ✅ thêm dòng này
});

// admin