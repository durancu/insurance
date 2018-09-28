<?php

namespace Arane\Email\Services\Controllers;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Arane\Email\Services\Handlers\EmailTemplateService;
use Arane\Email\Services\Requests\EmailTemplateCreateRequest;
use Arane\Email\Services\Requests\EmailTemplateUpdateRequest;
use Illuminate\Http\Response;
use Exception;

/**
 * Class EmailTemplatesController
 *
 * @package Arane\Email\Services\Controllers
 * @resource Email: Templates
 */
class EmailTemplatesController extends BaseAPIController {
    
    /**
     * @var EmailTemplateService
     */
    protected $emailTemplateService;
    
    /**
     * EmailTemplatesController constructor.
     *
     */
    public function __construct(EmailTemplateService $emailTemplateService) {
        $this->emailTemplateService = $emailTemplateService;
    }
    
    /**
     * Get all email templates.
     *
     * @return Response
     */
    public function index() {
        
        try {
            $emailTemplates = $this->emailTemplateService->search();
            
            
            return response()->json([
                'success' => true,
                'data' => $emailTemplates,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Get a specific email template.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $emailTemplate = $this->emailTemplateService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $emailTemplate,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Create email template.
     *
     * @param  EmailTemplateCreateRequest $request
     *
     * @return Response
     */
    public function store(EmailTemplateCreateRequest $request) {
        
        try {
            
            $emailTemplate = $this->emailTemplateService->create($request->all());
            
            $response = [
                'success' => true,
                'data' => $emailTemplate,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on create request');
        }
    }
    
    /**
     * Update email template.
     *
     * @param  EmailTemplateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(EmailTemplateUpdateRequest $request, $id) {
        
        try {
            
            $updated = $this->emailTemplateService->update($id, $request->all());
            
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
     * Bulk update to email templates.
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            $id = $request->get('id');
            
            $updated = $this->emailTemplateService->update($id, $attributes);
            
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
     * Delete email template.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->emailTemplateService->delete($id);
            
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
     * Bulk delete to email templates.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->emailTemplateService->delete($request->get('id'));
            
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
     * Restore email template.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function restore($id) {
        
        try {
            
            $restored = $this->emailTemplateService->restore($id);
            
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
     * Bulk restore to email templates.
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->emailTemplateService->restore($request->get('id'));
            
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
     * Get email templates as option list.
     *
     * @return Response
     */
    public function listAsOptions() {
        
        try {
            
            $emailTemplates = $this->emailTemplateService->listAsOptions('id', 'id', 'display_name');
            
            return response()->json([
                'success' => true,
                'data' => $emailTemplates,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on template request');
        }
    }
    
    /**
     * Search & list email templates.
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
     *    **Condition example**: Search for (templates with name like %-admin) OR (display_name like % Admin)
     *    - name : '%-admin' : like | or @ key : '% Admin' : like
     *
     * @param SearchRequest $request
     * @return Response
     */
    public function search(SearchRequest $request) {
        
        try {
            
            $emailTemplates = $this->emailTemplateService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $emailTemplates,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
}