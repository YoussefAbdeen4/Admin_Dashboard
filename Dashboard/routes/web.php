<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubcategoryController;

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
    return view('dashboard');
})->middleware('verified');
Route::group(['prefix' => 'Dashboard', 'middleware' => 'verified'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
        Route::get('/all', [ProductController::class, 'all'])->name('all');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
        Route::get('/all', [UsersController::class, 'all'])->name('all');
    });

    Route::group(['prefix' => 'subcategories', 'as' => 'subcategory.'], function () {
        Route::get('/all', [SubcategoryController::class, 'all'])->name('all');
        Route::get('/create', [SubcategoryController::class, 'create'])->name('create');
        Route::post('/store', [SubcategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SubcategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SubcategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SubcategoryController::class, 'delete'])->name('delete');
    });

     Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::get('/all', [CategoryController::class, 'all'])->name('all');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

     Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
        Route::get('/all', [OrderController::class, 'all'])->name('all');
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
