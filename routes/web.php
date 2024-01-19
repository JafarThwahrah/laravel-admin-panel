<?php

use App\Http\Controllers\ProfileController;
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
    return view('auth.login');
});



Route::get('/dashboard', function () {
    return redirect()->route('categories.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::controller(\App\Http\Controllers\CategoryController::class)->name('categories.')->prefix('categories')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{category}', 'edit')->name('edit');
        Route::get('/show/{category}', 'show')->name('show');
        Route::patch('/update/{category}', 'update')->name('update');
        Route::delete('/delete/{category}', 'destroy')->name('destroy');
    });
    Route::controller(\App\Http\Controllers\TagController::class)->name('tags.')->prefix('tags')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{tag}', 'edit')->name('edit');
        Route::get('/show/{tag}', 'show')->name('show');
        Route::patch('/update/{tag}', 'update')->name('update');
        Route::delete('/delete/{tag}', 'destroy')->name('destroy');
    });
    Route::controller(\App\Http\Controllers\ProductController::class)->name('products.')->prefix('products')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::get('/show/{product}', 'show')->name('show');
        Route::patch('/update/{product}', 'update')->name('update');
        Route::delete('/delete/{product}', 'destroy')->name('destroy');
        Route::post('/order/change-order', 'changeOrder')->name('changeOrder');
    });
});

require __DIR__ . '/auth.php';
