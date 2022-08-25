<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['role:admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.home');
    //users
    Route::get('/users', [UserController::class, 'index'])->name('user.list');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    //outlet
    Route::get('/outlets', [OutletController::class, 'index'])->name('outlet.list');
    Route::get('/outlet/create', [OutletController::class, 'create'])->name('outlet.create');
    Route::post('/outlet/create', [OutletController::class, 'store'])->name('outlet.store');
    Route::get('/outlet/show/{id}', [OutletController::class, 'show'])->name('outlet.show');
    Route::get('/outlet/edit/{id}', [OutletController::class, 'edit'])->name('outlet.edit');
    Route::post('/outlet/update/{id}', [OutletController::class, 'update'])->name('outlet.update');
    Route::delete('/outlet/destroy/{id}', [OutletController::class, 'destroy'])->name('outlet.destroy');

});

//other role users dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');
