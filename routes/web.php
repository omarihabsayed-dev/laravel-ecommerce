<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeSlidesController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)
    ->prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function (): void {
        Route::get('/logout', 'destroy')->name('logout');
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/edit', 'store')->name('store');
        Route::get('/password', 'changePassword')->name('password');
        Route::post('/password', 'updatePassword')->name('update.password');
    });

Route::controller(HomeSlidesController::class)
    ->prefix('admin/home-slides')
    ->name('home-slides.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });

Route::controller(AboutController::class)
    ->prefix('admin/about')
    ->name('about.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
        Route::get('/multi-images', 'multiImages')->name('multi-images');
        Route::post('/multi-images', 'store')->name('store');
    });

Route::controller(PortfolioController::class)
    ->prefix('admin/portfolio')
    ->name('portfolio.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });

Route::controller(PortfolioController::class)
    ->prefix('portfolio')
    ->name('portfolio.')
    ->group(function (): void {
        Route::get('/', 'show')->name('show');
    });

Route::controller(BlogCategoryController::class)
    ->prefix('admin/category')
    ->name('category.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{BlogCategory}', 'edit')->name('edit');
        Route::post('/{BlogCategory}', 'update')->name('update');
        Route::delete('/{BlogCategory}', 'destroy')->name('delete');
    });

Route::controller(BlogController::class)
    ->prefix('admin/blog')
    ->name('blog.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{blog}', 'edit')->name('edit');
        Route::post('/edit/{blog}', 'update')->name('update');
        Route::delete('/delete/{blog}', 'destroy')->name('destroy');
    });

Route::controller(BlogController::class)
    ->prefix('blog')
    ->name('blog.')
    ->group(function (): void {
        Route::get('/', 'home')->name('home');
        Route::get('/category/{blogCategory}', 'posts')->name('posts');
        Route::get('/{blog}', 'show')->name('show');
    });

Route::controller(FooterController::class)
    ->prefix('admin/footer')
    ->name('footer.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });

Route::controller(ContactController::class)
    ->prefix('contact')
    ->name('contact.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

Route::controller(ContactController::class)
    ->prefix('admin/contact')
    ->name('contact.')
    ->group(function (): void {
        Route::get('/', 'show')->name('show');
        Route::delete('/{contact}', 'destroy')->name('destroy');
    });
Route::get('/about', [AboutController::class, 'show'])->name('about.show');
require __DIR__.'/auth.php';
