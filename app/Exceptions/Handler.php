<?php

namespace App\Exceptions;


use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Not found'
                ], 404);
            }
        });
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Method is wrong'
                ], 405);
            }
        });
        $this->renderable(function (\BadMethodCallException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Method is not exist'
                ], 404);
            }
        });
        $this->renderable(function (\Error $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Internal error, pls report about problem to administrator'
                ], 404);
            }
        });
        $this->renderable(function (\InvalidArgumentException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Error with sent data'
                ], 404);
            }
        });

    }}

