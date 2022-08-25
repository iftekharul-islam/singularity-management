<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OutletController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', [AuthController::class, 'profile']);

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);

    //user crud
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/user/create', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy']);

    //outlet crud
    Route::get('/outlets', [OutletController::class, 'index']);
    Route::post('/outlet/create', [OutletController::class, 'store']);
    Route::get('/outlet/show/{id}', [OutletController::class, 'show']);
    Route::post('/outlet/update/{id}', [OutletController::class, 'update']);
    Route::delete('/outlet/destroy/{id}', [OutletController::class, 'destroy']);

});
