<?php

namespace Arane\Email\Services\Controllers;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Arane\Email\Services\Handlers\EmailTypeService;
use Arane\Email\Services\Requests\EmailTypeCreateRequest;
use Arane\Email\Services\Requests\EmailTypeUpdateRequest;
use Illuminate\Http\Response;
use Exception;

/**
 * Class EmailTypesController
 *
 * @package  Arane\Email\Services\Controllers
 * @resource Email: Types
 */
class EmailTypesController extends BaseAPIController {
    
    /**
     * @var EmailTypeService
     */
    protected $emailTypeService;
    
    /**
     * EmailTypesController constructor.
     *
     */
    public function __construct(EmailTypeService $emailTypeService) {
        $this->emailTypeService = $emailTypeService;
    }
    
    /**
     * Get all email types.
     *
     * @return Response
     */
    public function index() {
        
        try {
            $emailTypes = $this->emailTypeService->search();
            
            
            return response()->json([
                'success' => true,
                'data' => $emailTypes,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Get a specific email type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $emailType = $this->emailTypeService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $emailType,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Create email type.
     *
     * @param  EmailTypeCreateRequest $request
     *
     * @return Response
     */
    public function store(EmailTypeCreateRequest $request) {
        
        try {
            
            $emailType = $this->emailTypeService->create($request->all());
            
            $response = [
                'success' => true,
                'data' => $emailType,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on create request');
        }
    }
    
    /**
     * Update email type.
     *
     * @param  EmailTypeUpdateRequest $request
     * @param  string                 $id
     *
     * @return Response
     */
    public function update(EmailTypeUpdateRequest $request, $id) {
        
        try {
            
            $updated = $this->emailTypeService->update($id, $request->all());
            
            $response = [
                'success' => true,
                'data' => $updated,
            ];
            
            
            return response()->json($response);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on update request');
        }
    }
    
    /**
     * Bulk update to email types.
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            $id = $request->get('id');
            
            $updated = $this->emailTypeService->update($id, $attributes);
            
            $response = [
                'success' => true,
                'data' => $updated,
            ];
            
            
            return response()->json($response);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on bulk update request');
        }
    }
    
    
    /**
     * Delete email type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->emailTypeService->delete($id);
            
            return response()->json([
                'success' => true,
                'data' => $deleted,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on delete request');
        }
    }
    
    /**
     * Bulk delete to email types.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->emailTypeService->delete($request->get('id'));
            
            return response()->json([
                'success' => true,
                'data' => $deleted,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on bulk delete request');
        }
    }
    
    /**
     * Restore email type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function restore($id) {
        
        try {
            
            $restored = $this->emailTypeService->restore($id);
            
            return response()->json([
                'success' => true,
                'data' => $restored,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on restore request');
        }
    }
    
    /**
     * Bulk restore to email types.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->emailTypeService->restore($request->get('id'));
            
            return response()->json([
                'success' => true,
                'data' => $restored,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on bulk restore request');
        }
    }
    
    /**
     * Get email types as option list.
     *
     * @return Response
     */
    public function listAsOptions() {
        
        try {
            
            $emailTypes = $this->emailTypeService->listAsOptions('id', 'id', 'display_name');
            
            return response()->json([
                'success' => true,
                'data' => $emailTypes,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on type request');
        }
    }
    
    /**
     * Search & list email types.
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
     *    **Condition example**: Search for (types with name like %-admin) OR (display_name like % Admin)
     *    - name : '%-admin' : like | or @ key : '% Admin' : like
     *
     * @param SearchRequest $request
     * @return Response
     */
    
    public function search(SearchRequest $request) {
        
        try {
            
            $emailTypes = $this->emailTypeService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $emailTypes,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
}