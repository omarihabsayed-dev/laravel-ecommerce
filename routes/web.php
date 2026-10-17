<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/logout', 'destroy')->name('logout');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/edit', 'edit')->name('edit');
    Route::post('/edit', 'store')->name('store');
    Route::get('/password', 'changePassword')->name('password');
    Route::post('/password', 'updatePassword')->name('update.password');
});

require __DIR__.'/auth.php';
