<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\TenantController;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('tenants.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});
Route::middleware('admin')->group(function () {
    Route::get('/adminDashboard', [AuthController::class, 'adminDashboard'])->name('admins.dashboard');
    Route::resource('houses', HouseController::class);
    Route::resource('houses.users', TenantController::class)->except('index');
    Route::resource('houses.users.bills', BillController::class)->except('index');
    Route::put('houses.users.bills', [BillController::class, 'publish'])->name('publish');
});
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});
