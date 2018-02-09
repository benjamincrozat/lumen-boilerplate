<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // Render as HTML if the client didn't request JSON.
        if (! $request->wantsJson()) {
            return parent::render($request, $e);
        }

        // Render as JSON if the client requested JSON.
        return $this->jsonException($e);
    }

    public function jsonException(Exception $e)
    {
        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return response()->json($e->errors(), $e->status);
        }

        return response()->json([
            'code'    => $code = $this->getExceptionCode($e),
            'message' => $e->getMessage(),
        ], $code);
    }

    /**
     * Get code associated with a given exception.
     *
     * @param Exception $e
     *
     * @return int
     */
    protected function getExceptionCode(Exception $e)
    {
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        }

        if (method_exists($e, 'getCode') && 0 !== $e->getCode()) {
            return $e->getCode();
        }

        return 500;
    }
}
