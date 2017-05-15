<?php

namespace App\Exceptions;

use Request;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
    * A list of the exception types that should not be reported.
    *
    * @var array
    */
    protected $dontReport = [
    \Illuminate\Auth\AuthenticationException::class,
    \Illuminate\Auth\Access\AuthorizationException::class,
    \Symfony\Component\HttpKernel\Exception\HttpException::class,
    \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    \Illuminate\Session\TokenMismatchException::class,
    \Illuminate\Validation\ValidationException::class,
    ];
    
    /**
    * Report or log an exception.
    *
    * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
    *
    * @param  \Exception  $exception
    * @return void
    */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    
    /**
    * Render an exception into an HTTP response.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Exception  $exception
    * @return \Illuminate\Http\Response
    */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof CustomException) {
        }
        if (Request::is('api/*')) {
            return $this->renderCustomErrorJson($exception);
        }
        if ($this->isHttpException($exception)) {
            return $this->renderCustomErrorPage($exception);
        }
        return parent::render($request, $exception);
    }
    
    /**
    * Convert an authentication exception into an unauthenticated response.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Illuminate\Auth\AuthenticationException  $exception
    * @return \Illuminate\Http\Response
    */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        
        return redirect()->guest('login');
    }
            
    private function renderCustomErrorPage($exceptione)
    {
        $status = $exceptione->getStatusCode();
        
        switch ($status) {
            case '503':
                return response()->view('errors.503', [
                ], 503)->header("Retry-After", "1800");
                
            case '404':
            default :
                return response()->view('errors.404', [], $status);
        }
    }
            
    private function renderCustomErrorJson($exceptione)
    {
        $status = $exceptione->getStatusCode();
        return response()->json([
                'error' => 'No API.',
                'http_code' => $status
            ], $status);

    }
}
