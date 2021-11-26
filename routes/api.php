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
Route::apiResources([
    'desks'=>DeskController::class,

]);

//Route::group(['middleware'=>['auth:sanctum']], function()

    Route::middleware('auth:api')->match(['post', 'get'], '/user/{id}', [APIController::class, 'index'])->name('index');

   // Route::middleware('auth:api')->post('/desks/new', function (Request $request){

     //  return $request ->user()->Desk()-create($request->only(['title','content']));
 //  });

        Route::middleware('auth:api')->get('/desks/search/{name}', [APIController::class, 'search']);

    Route::post('/desks/store', [APIController::class, 'store']);

    Route::post('/register/logout', [AuthController::class, 'logout']);

    Route::get('/desks/show/{id}', [APIController::class, 'show']);

    Route::put('/desks/update/{id}', [APIController::class, 'update']);

    Route::put('/desks/delete/{id}', [APIController::class, 'destroy']);

