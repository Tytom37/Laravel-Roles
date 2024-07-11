<?php

use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/logs', [UserController::class, 'logs'])->name('user.logs');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::post('/user/export', [UserController::class, 'exportExcel'])->name('user.excel');
    Route::post('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
//     Route::middleware('role:admin')->group(function () {
//         Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//         Route::post('/users', [UserController::class, 'store'])->name('users.store');
//         Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//         Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
//         Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//     });
// });

// Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('users/export-excel', [UserController::class, 'exportExcel'])->name('users.download-excel');

require __DIR__.'/auth.php';
