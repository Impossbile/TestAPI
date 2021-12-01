<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\User;
use \App\Http\Controllers\APIController;
use  \App\Http\Controllers\AuthController;
use App\Models\Desk;

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

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], static function () {
    Route::apiResources([
        'desks' => DeskController::class,

    ]);
});
