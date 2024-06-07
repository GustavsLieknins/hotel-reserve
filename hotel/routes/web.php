<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\admin;
use App\Http\Middleware\superAdmin;

Route::get('/larthing', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
})->name("/");

Route::middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');
    Route::get('/superadmin/findUser', [SuperAdminController::class, 'findUser'])->name('findUser');
    Route::get('/superadmin/roleChange', [SuperAdminController::class, 'roleChange']);
    Route::delete('/superadmin/userDelete', [SuperAdminController::class, 'userDelete']);
});

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
