<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\testController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('/products', ProductController::class);


// if you want to authenticate user who uses an api
Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::get('/products/search/{name}', [ProductController::class,'search']);

        Route::post('/logout', [AuthController::class, 'logout']);
});





Route::resource('/test', testController::class);


// Route::post('/products', [ProductController::class,'purchase']);