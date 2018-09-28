<?php

namespace Arane\Email\Services\Controllers;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Arane\Email\Services\Handlers\EmailListService;
use Arane\Email\Services\Requests\EmailListCreateRequest;
use Arane\Email\Services\Requests\EmailListUpdateRequest;
use Exception;
use Illuminate\Http\Response;

/**
 * Class EmailListsController
 *
 * @package  Arane\Email\Services\Controllers
 * @resource Email: Lists
 */
class EmailListsController extends BaseAPIController {
    
    /**
     * @var EmailListService
     */
    protected $emailListService;
    
    /**
     * EmailListsController constructor.
     *
     */
    public function __construct(EmailListService $emailListService) {
        $this->emailListService = $emailListService;
    }
    
    /**
     * Get all email lists.
     *
     * @return Response
     */
    public function index() {
        
        try {
            $emailLists = $this->emailListService->search();
            
            
            return response()->json([
                'success' => true,
                'data' => $emailLists,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Create email list.
     *
     * @param  EmailListCreateRequest $request
     *
     * @return Response
     */
    public function store(EmailListCreateRequest $request) {
        
        try {
            
            $emailList = $this->emailListService->create($request->all());
            
            $response = [
                'success' => true,
                'data' => $emailList,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on create request');
        }
    }
    
    /**
     * Get a specific email list.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $emailList = $this->emailListService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $emailList,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Update email list.
     *
     * @param  EmailListUpdateRequest $request
     * @param  string                 $id
     *
     * @return Response
     */
    public function update(EmailListUpdateRequest $request, $id) {
        
        try {
            
            $updated = $this->emailListService->update($id, $request->all());
            
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
     * Bulk update to email lists.
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            $id = $request->get('id');
            
            $updated = $this->emailListService->update($id, $attributes);
            
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
     * Delete email list.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->emailListService->delete($id);
            
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
     * Bulk delete to email lists.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->emailListService->delete($request->get('id'));
            
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
     * Restore email list.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function restore($id) {
        
        try {
            
            $restored = $this->emailListService->restore($id);
            
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
     * Bulk update to email lists.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->emailListService->restore($request->get('id'));
            
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
     * Get email lists as option list.
     *
     * @return Response
     */
    public function listAsOptions() {
        
        try {
            
            $emailLists = $this->emailListService->listAsOptions('id', 'id', 'display_name');
            
            return response()->json([
                'success' => true,
                'data' => $emailLists,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on list request');
        }
    }
    
    /**
     * Search & list email lists.
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
     *    **Condition example**: Search for (lists with name like %-admin) OR (display_name like % Admin)
     *    - name : '%-admin' : like | or @ key : '% Admin' : like
     *
     * @param SearchRequest $request
     * @return Response
     */
    public function search(SearchRequest $request) {
        
        try {
            
            $emailLists = $this->emailListService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $emailLists,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
}
