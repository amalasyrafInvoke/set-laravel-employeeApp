<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//   return $request->user();
// });

// Route::post('/login', [ApiController::class, 'login']);
// Route::post('/logout', [ApiController::class, 'logout']);

Route::group(['prefix' => 'auth'], function () {
  Route::post('/login', [ApiController::class, 'login']);

  Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('/logout', [ApiController::class, 'logout']);
    // Route::post('/refresh', [ApiController::class, 'refresh']);
    // Route::get('/user-profile', [ApiController::class, 'userProfile']);
    // Route::get('/dashboard', [ApiController::class, 'dashboard']);
  });
});

Route::group(['middleware' => 'auth.jwt'], function () {
  Route::get('/dashboard', [ApiController::class, 'dashboard']);
  Route::get('/users', [ApiController::class, 'users']);
});
