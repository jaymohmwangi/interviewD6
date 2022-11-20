<?php

namespace App\Exceptions;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Exceptions\HttpResponseException;
use PDOException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        //add Accept: application/json in request
        if ($exception instanceof ClientException || $exception instanceof RequestException|| $request->wantsJson() || $request->expectsJson() || $request->isJson()) {
            return $this->handleApiException($request, $exception);
        } else {
            // NotFoundHttpException
            if ($exception instanceof NotFoundHttpException) {
                $error = $exception->getMessage();
                return response()->view('errors.not_found', compact("error"), 500);
            }

            //Database  exception
            if ($exception instanceof PDOException) {
                $error = $exception->getMessage();
                return response()->view('errors.internal', compact("error"), 500);
            }
            //Route exception
            if ($exception instanceof RouteNotFoundException) {
                $error = $exception->getMessage();
                return response()->view('errors.internal', compact("error"), 500);
            }

            return parent::render($request, $exception);
        }
    }
    private function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);


        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }
        return $this->customApiResponse($exception);
    }
    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['errors'] =["err"=>["'Unauthorized'"]] ;
                break;
            case 403:
                $response['errors'] =["err"=>["'Forbidden'"]] ;
                break;
            case 404:
                $response['errors'] =["err"=>["Not Found"]] ;
                break;
            case 405:
                $response['errors'] =["err"=>["Method Not Allowed"]] ;
                break;
            case 422:
                $response['errors'] =["err"=>[$exception->original['errors']]];
                break;
            default:
                $response['errors'] = ["err"=>[$exception->getMessage()]];
                break;
        }

        if (config('app.debug')) {
            $response['success'] = false;
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
            $response['message'] = $exception->getMessage();
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }
}
