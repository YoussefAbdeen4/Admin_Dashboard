<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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
    return view('dashboard');
})->middleware('verified');
Route::group(['prefix'=>'Dashboard','middleware'=>'verified'],function (){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        Route::group(['prefix'=>'products','as'=>'product.'],function (){
            Route::get('/all',[ProductController::class,'all'])->name('all');
            Route::get('/create',[ProductController::class,'create'])->name('create');
            Route::post('/store',[ProductController::class,'store'])->name('store');
            Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
            Route::put('/update/{id}',[ProductController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[ProductController::class,'delete'])->name('delete');
        });

    Route::group(['prefix'=>'users','as'=>'user.'],function (){
        Route::get('/all',[UsersController::class,'all' ])->name('all');
        Route::get('/create',[UsersController::class,'create'])->name('create');
        Route::get('/store',[UsersController::class,'store'])->name('store');
        Route::get('/edit',[UsersController::class,'edit'])->name('edit');
        Route::get('/delete',[UsersController::class,'delete'])->name('delete');
    });
});


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
