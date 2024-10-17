<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
{
    // Verificar si el error es un 419 (CSRF Token Expired)
    if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
        // Redirigir a la página de inicio de sesión o a una página personalizada
        return redirect()->route('login')->with('message', 'Tu sesión ha caducado, por favor inicia sesión de nuevo.');
    }

    // Continuar con el manejo de otros errores
    return parent::render($request, $exception);
}

}
