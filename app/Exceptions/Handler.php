<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Laravel\Socialite\Two\InvalidStateException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception) {

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\Response | mixed
     */
    public function render($request, Exception $exception) {

        $errors = ['key' => '', 'message' => ''];
        $back = false;
        $route = '';
        $handled = false;

        /*if ($exception instanceof ModelNotFoundException) {
            $errors['key'] = 'errors';
            $errors['message'] = 'Model not found exception';
            $back = true;
            $handled = true;
        }*/

        if ($exception instanceof TokenMismatchException) {
            $errors['key'] = 'token_mismatch';
            $errors['message'] = 'Invalid token';
            $route = 'login';
            $handled = true;
        }

        if ($exception instanceof InvalidStateException) {
            $errors['key'] = 'password';
            $errors['message'] = 'Session expired';
            $route = 'login';
            $handled = true;
        }

        if ($exception instanceof AuthenticationException) {
            $errors['key'] = 'password';
            $errors['message'] = 'Unauthenticated';
            $route = 'login';
            $handled = true;
        }

        /*if ($exception instanceof \ReflectionException) {
            $errors['key'] = 'error';
            $errors['message'] = 'Error sending model notification';
            $back = true;
            $handled = true;
        }*/

        /*if ($exception instanceof ValidatorException) {
            $errors['key'] = 'error';
            $errors['message'] = $exception->getMessage();
            $back = true;
            $handled = true;
        }*/

        /*if ($exception instanceof FileNotFound || $exception instanceof FileNotFoundException) {
            $errors['key'] = 'error';
            $errors['message'] = $exception->getMessage();
            $back = true;
            $handled = true;
        }*/
        
        
        if ($handled) {
            
            if ($request->segments()[0]==='api') {

                $responseData = [
                    'success' => false,
                    'data' => $errors['message'],
                ];

                /*if (config('app.debug')){
                    $responseData['debug'] = $exception->getTrace();
                }*/
                
                return response()->json($responseData, 200);
            }

            if ($route !== '') {
                $response = redirect($route);
            } else {
                $response = redirect();
                if ($back) {
                    $response = $response->back(401)->with('status', $exception->getMessage());
                }
            }

            if ($errors['key'] !== '') {
                $response = $response->withErrors($errors);
            }

            return $response;
        }

        return parent::render($request, $exception);
    }
}
