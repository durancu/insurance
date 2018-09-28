<?php

namespace Arane\Base\Services\Controllers;

use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\RoleCreateRequest;
use Arane\Base\Services\Requests\RoleUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Exception;
use Arane\Base\Services\Handlers\RoleService;

/**
 * Class RolesController.
 *
 * @package  namespace Arane\Base\Services\Controllers;
 * @resource User: Roles
 */
class RolesController extends BaseAPIController {
    
    protected $roleService;
    
    /**
     * RolesController constructor.
     *
     */
    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }
    
    /**
     * Get all user roles.
     *
     * @return Response
     */
    public function index() {
        
        try {
            $roles = $this->roleService->search();
            
            
            return response()->json([
                'success' => true,
                'data' => $roles,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Get a specific user role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $role = $this->roleService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $role,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Create user role.
     *
     * @param  RoleCreateRequest $request
     *
     * @return Response
     */
    public function store(RoleCreateRequest $request) {
        
        try {
            
            $role = $this->roleService->create($request->all());
            
            $response = [
                'success' => true,
                'data' => $role,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on create request');
        }
    }
    
    /**
     * Update user role.
     *
     * @param  RoleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RoleUpdateRequest $request, $id) {
        
        try {
            
            $updated = $this->roleService->update($id, $request->all());
            
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
     * Bulk update to user roles
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            $id = $request->get('id');
            
            $updated = $this->roleService->update($id, $attributes);
            
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
     * Delete user role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->roleService->delete($id);
            
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
     * Bulk delete to user roles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->roleService->delete($request->get('id'));
            
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
     * Restore user role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function restore($id) {
        
        try {
            
            $restored = $this->roleService->restore($id);
            
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
     * Bulk restore to user roles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->roleService->restore($request->get('id'));
            
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
     * Search & list user roles.
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
     *    **Condition example**: Search for (roles with name like %-admin) OR (display_name like % Admin)
     *    - name : '%-admin' : like | or @ key : '% Admin' : like
     *
     * @param SearchRequest $request
     * @return Response
     */
    public function search(SearchRequest $request) {
        
        try {
            
            $roles = $this->roleService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $roles,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
    
    /**
     * Get user roles as option list.
     *
     * @return Response
     */
    public function listAsOptions() {
        
        try {
            
            $roles = $this->roleService->listAsOptions('id', 'id', 'display_name');
            
            return response()->json([
                'success' => true,
                'data' => $roles,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on list request');
        }
    }
}
