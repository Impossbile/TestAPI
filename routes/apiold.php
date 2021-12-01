//Route::group(['middleware'=>['auth:sanctum']], function()

Route::middleware('auth:api')->match(['post', 'get'], '/user/{id}', [APIController::class, 'index'])->name('index');

// Route::middleware('auth:api')->post('/desks/new', function (Request $request){

//  return $request ->user()->Desk()-create($request->only(['title','content']));
//  });

Route::middleware('auth:api')->group(function () {

Route::get('/desks/search/{name}', [APIController::class, 'search']);

Route::post('/desks/store', [APIController::class, 'store']);

Route::post('/register/logout', [AuthController::class, 'logout']);

Route::get('/desks/show/{id}', [APIController::class, 'show']);

Route::put('/desks/update/{id}', [APIController::class, 'update']);

Route::put('/desks/delete/{id}', [APIController::class, 'destroy']);

});
