<?php

namespace Arane\Base\Services\Controllers;

use Arane\Base\Services\Requests\ListOptionsRequest;
use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Arane\Base\Services\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Exception;
use Arane\Base\Services\Handlers\UserService;

/**
 * Class UsersController.
 *
 * @package  namespace Arane\Base\Services\Controllers;
 * @resource User: Users
 */
class UsersController extends BaseAPIController {
    
    protected $userService;
    
    /**
     * UsersController constructor.
     *
     */
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    
    /**
     * Get all users.
     *
     * @return Response
     * @throws Exception
     */
    public function index() {
        
        try {
            $users = $this->userService->search();
            
            return response()->json([
                'success' => true,
                'data' => $users,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Get a specific user.
     *
     * @param  int $id
     *
     * @return Response
     *
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function show($id) {
        
        try {
            
            $user = $this->userService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Create user (deprecated).
     *
     *   See: RegisterController::register()
     *
     * @throws Exception
     */
    public function store() {
        
        /*try {
            
            $user = $this->userService->create($request->all());
            
            $response = [
                'success' => true,
                'data' => $user,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'data' => 'Exception occurred on create action'
            ];
            
            if (config('app.debug')) {
                $response['message'] = $e->getMessage();
                $response['debug'] = $e->getTrace();
            }
            
            return response()->json($response);
        }*/
        
        return $this->exceptionResponse(new Exception(), 'Unavailable request route. Please use Auth API register function.', 200);
    }
    
    /**
     * Update user.
     *
     * @param  UserUpdateRequest $request
     * @param  int               $id
     *
     * @return Response
     *
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function update(UserUpdateRequest $request, $id) {
        
        try {
            
            $updated = $this->userService->update($id, $request->all());
            
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
     * Bulk update to users.
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     *
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            $id = $request->get('id');
            
            $updated = $this->userService->update($id, $attributes);
            
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
     * Delete user.
     *
     * @param  int $id
     *
     * @return Response
     *
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->userService->delete($id);
            
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
     * Bulk delete to users.
     *
     * @param ModelBulkDeleteRequest $request
     *
     * @return Response
     *
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->userService->delete($request->get('id'));
            
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
     * Restore user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function restore($id) {
        
        try {
            
            $restored = $this->userService->restore($id);
            
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
     * Bulk restore to users.
     *
     * @param  ModelBulkRestoreRequest $request
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->userService->restore($request->get('id'));
            
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
     * Get users as options list.
     *
     * @param ListOptionsRequest $request
     *
     * @return Response
     */
    public function listAsOptions(ListOptionsRequest $request) {
        
        try {
            
            $users = $this->userService->listAsOptions('id', 'id', 'display_name');
            
            return response()->json([
                'success' => true,
                'data' => $users,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on list request');
        }
    }
    
    /**
     * Search & list users.
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
     *    - Join operator (optional) => and @, or @
     *
     *    **Condition example**: Search for (users with first_name =John) AND (email like %gmail.com)
     *      first_name : 'John' | or @ email : '%gmail.com' : like
     *
     * @param SearchRequest $request
     * @return Response
     */
    public function search(SearchRequest $request) {
        
        try {
            
            $users = $this->userService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $users,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
}
