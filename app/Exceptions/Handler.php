<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'res'       => 'Los datos proporcionados en tu consulta no son válidos',
            'errores'   => $exception->errors()
        ], $exception->status);
    }
    
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'res'       => false,
                'error'     => 'Datos no encontrados en la base de datos'
            ], 400);

            return parent::render($request, $exception);
        }
    }
}
