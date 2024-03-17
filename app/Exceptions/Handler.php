<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Auth;
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
        'password',
        'password_confirmation',
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
    //   if($this->isHttpException($exception)){
    //   switch ($exception->getStatusCode()) {
    //      case 404:
    //       return redirect()->route('error404');
    //       break;
    //      case 500:
    //       return redirect()->route('error500');
    //       break;
         //
         // case 401:
         //     return redirect()->route('main');
         //     break;
         // case 403:
         //   return redirect()->route('main');
         //   break;
         // default:
         //   return  $this->renderHttpException($e);
         //   break;
    //   }
    //  }
    //  if ($e instanceof TokenMismatchException){
    //         return redirect($request->fullUrl())->with('csrf_error',"Opps! Seems you couldn't submit form for a longtime. Please try again");
    //     }
        return parent::render($request, $exception);
    }
}
