<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::auth();
Route::middleware('auth')->get('/user', function(Request $request) {

  return $request->user();

});

Route::get('/', function() {
    return view('app');
});

// Route::get('/{any}', function() {
//     return view('app');
// })->where('any', '.*');


Route::get('/auth', function() {
  return "ok";
})->middleware('auth');
// どんなURLでもview('app')を返す

Route::get('/{any?}', function () {
    return view('app');
})->where('any','^(?!api\/)[\/\w\.-]*');