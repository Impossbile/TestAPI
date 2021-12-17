<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\TeestController;
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
Route::get('test',[TeestController::class,'index']);
Route::post('read/xlsx',[ExcelController::class, 'readxlsx']);
Route::post('books/import', [ExcelController::class, 'import']);
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/clients', function (Request $request) {
    return view('clients', [
        'clients' => $request->user()->clients

    ]);
        })->middleware(['auth'])->name('dashboard.clients');


require __DIR__.'/auth.php';
