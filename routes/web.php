<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//home routes
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/login', [HomeController::class, 'login'])->name('homepage.login');
Route::post('/login', [HomeController::class, 'check_login']);
Route::get('/logout', [HomeController::class, 'logout'])->name('homepage.logout');
Route::get('/register', [HomeController::class, 'register'])->name('homepage.register');
Route::post('/register', [HomeController::class, 'check_register']);

//admin routes
Route::group(['prefix' => 'admin','middleware' => ['auth', 'admin']], function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    //accounts
    Route::get('/accounts', [AdminController::class, 'account'])->name('admin.accounts.index');
    Route::get('/accounts/create', [AdminController::class, 'create_account'])->name('admin.accounts.create');
    Route::post('/accounts', [AdminController::class, 'store_account'])->name('admin.accounts.store');
    Route::get('/accounts/{user}/edit', [AdminController::class, 'edit_account'])->name('admin.accounts.edit');
    Route::put('/accounts/{user}', [AdminController::class, 'update_account'])->name('admin.accounts.update');
    Route::delete('/accounts/{user}', [AdminController::class, 'destroy_account'])->name('admin.accounts.destroy');
    //roles
    // Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    // Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    // Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    // Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    // Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    // Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
});

//user routes
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/password', [UserController::class, 'password'])->name('profile.password');
//course routes

