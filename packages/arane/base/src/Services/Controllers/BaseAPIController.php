<?php

namespace Arane\Base\Services\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Exception;

/**
 * Class BaseAPIController.
 *
 * @package namespace Arane\Base\Services\Controllers;
 */
class BaseAPIController extends Controller {
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected function exceptionResponse($exception, $message='',$code=500){
        $response = [
            'success' => false,
            'data' => $message
        ];
    
        if (config('app.debug')) {
            $response['message'] = $exception->getMessage();
            $response['debug'] = $exception->getTrace();
        }
    
        return response()->json($response, $code);
    }
}
