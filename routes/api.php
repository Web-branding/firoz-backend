<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('application', [ApiController::class, 'application']);
// Route::get('search/{id}', [ApiController::class, 'search']);
Route::post('search', [ApiController::class, 'search']);

Route::get('slides', [ApiController::class,'slide']);
Route::get('videos', [ApiController::class,'videos']);
