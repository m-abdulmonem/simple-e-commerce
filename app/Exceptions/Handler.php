<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function render($request, Exception|Throwable $exception)
    {
        if ($request->is("api/*")) {
            $statusCode = (method_exists($exception, 'getStatusCode')) ? $exception->getStatusCode() : 500;

            if ($exception instanceof ModelNotFoundException) {
                return json(
                    "[".implode(",", $exception->getIds()) . "] " . __('Item Not Found'),
                    status: 'error',
                    headerStatus: $statusCode
                );
            }
            return json(
                $exception,
                status: 'error',
                message: $exception->getMessage(),
                headerStatus: $statusCode
            );
        }
        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
