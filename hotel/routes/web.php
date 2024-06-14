<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\admin;
use App\Http\Middleware\superAdmin;

Route::get('/larthing', function () {
    return view('welcome');
});


Route::get('/', [IndexController::class, 'index'])->name('/');
Route::get("/room/{id}", [IndexController::class, "show"]);

Route::middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');
    Route::get('/superadmin/findUser', [SuperAdminController::class, 'findUser'])->name('findUser');
    Route::get('/superadmin/roleChange', [SuperAdminController::class, 'roleChange']);
    Route::delete('/superadmin/userDelete', [SuperAdminController::class, 'userDelete']);
});

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::get('/add-room', [AdminController::class, 'showAddRoom'])->name('add-room');
    Route::post('/add-room', [AdminController::class, 'roomStore'])->name('room-store');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations');
    Route::post('/reservation-status/{id}', [AdminController::class, 'changeReservationStatus'])->name('reservation-status');

    Route::delete('/admin/rooms/{id}', [AdminController::class, 'roomDelete'])->name('room-delete');

    
    Route::get('/admin/rooms/{id}/edit', [AdminController::class, 'edit'])->name('room-edit');
    Route::post('/admin/rooms/{id}', [AdminController::class, 'update'])->name('room-update');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/account', [IndexController::class, 'account'])->name('account');
    Route::get('/book/{id}', [IndexController::class, 'book'])->name('book');
    Route::post('/check-date', [IndexController::class, 'checkDate'])->name('check-date');

    
    Route::post('/cancel/{id}', [IndexController::class, 'cancel'])->name('cancel');

    
    // Route::get('/search', function(Illuminate\Http\Request $request){
    //     $query = $request->query('search');
    //     $rooms = Rooms::where('name', 'like', "%$query%")
    //         ->orWhere('description', 'like', "%$query%")
    //         ->get();
    //     return view('index', ['rooms' => $rooms]);
    // })->name('search');

    
    Route::get('/search', [IndexController::class, 'search'])->name('search');

    
    Route::get('/sort', [IndexController::class, 'sort'])->name('sort');

});
require __DIR__.'/auth.php';
