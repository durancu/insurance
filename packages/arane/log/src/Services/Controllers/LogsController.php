<?php

namespace Arane\Log\Services\Controllers;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Requests\SearchRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Exception;
use Arane\Log\Services\Handlers\LogService;

/**
 * Class LogsController.
 *
 * @package namespace Arane\Base\Services\Controllers;
 * @resource Log: Logs
 */
class LogsController extends BaseAPIController {
    
    /**
     * @var LogService
     */
    protected $logService;
    
    /**
     * LogsController constructor.
     *
     */
    public function __construct(LogService $logService) {
        $this->logService = $logService;
    }
    
    /**
     * Get all logs.
     *
     * @return Response
     */
    public function index() {
        
        try {
            $logs = $this->logService->search();
            
            
            return response()->json([
                'success' => true,
                'data' => $logs,
            ]);
    
        } catch (Exception $e) {
    
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Get a specific log.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $log = $this->logService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $log,
            ]);
    
        } catch (ModelNotFoundException $e) {
    
            return $this->exceptionResponse($e, 'Model not found exception', 200);
    
        } catch (Exception $e) {
    
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Search & list logs.
     *  **Parameter $request['options']:**
     *  - id                   => id or array of ids to retrieve
     *  - columns [array]      => columns to return
     *  - order [string|array] => specify order with string like 'criteria:direction'
     *  - limit [int]          => specify page items limit
     *  - no-paginate [bool]   => specify to not paginate results
     *  - scope [string]       => specify item status: deleted, active, all (active + deleted)
     *  - conditions [array]   => searching conditions (see explanation)
     *
     *    **Conditions syntax** =>  join @ condition ... | condition
     *    - Single Condition syntax  => column : value : operator
     *      - column (required)      => column to search
     *      - value (required)       => value to compare
     *      - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
     *    - Join operator (optional) => @and, @or
     *
     *    **Condition example**: Search for (logs with service like %-users) OR (action like % guide)
     *    - service : '%-users' : like | or @ action : '% guide' : like
     *
     * @param SearchRequest $request
     * @return Response
     */
    public function search(SearchRequest $request) {
        
        try {
            
            $logs = $this->logService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $logs,
            ]);
    
        } catch (Exception $e) {
    
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
}
