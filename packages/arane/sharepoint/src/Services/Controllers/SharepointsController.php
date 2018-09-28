<?php

namespace Arane\Sharepoint\Services\Controllers;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Requests\ListOptionsRequest;
use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Arane\Sharepoint\Services\Requests\SharepointCopyRequest;
use Arane\Sharepoint\Services\Requests\SharepointCreateRequest;
use Arane\Sharepoint\Services\Requests\SharepointListRequest;
use Arane\Sharepoint\Services\Requests\SharepointMoveRequest;
use Arane\Sharepoint\Services\Requests\SharepointRestoreRequest;
use Arane\Sharepoint\Services\Requests\SharepointShareRequest;
use Arane\Sharepoint\Services\Requests\SharepointUnShareRequest;
use Arane\Sharepoint\Services\Requests\SharepointUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Exception;
use Arane\Sharepoint\Services\Handlers\SharepointService;

/**
 * Class SharepointsController.
 *
 * @package  namespace Arane\Sharepoint\Services\Controllers;
 * @resource Sharepoint: Sharepoints
 */
class SharepointsController extends BaseAPIController {
    
    /**
     * @var SharepointService
     */
    protected $sharepointService;
    
    /**
     * SharepointsController constructor.
     *
     */
    public function __construct(SharepointService $sharepointService) {
        $this->sharepointService = $sharepointService;
    }
    
    /**
     * Get all sharepoints.
     *
     * @return Response
     */
    public function index() {
        
        try {
            
            $sharepoints = $this->sharepointService->search();
            
            return response()->json([
                'success' => true,
                'data' => $sharepoints,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Get a specific sharepoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $sharepoint = $this->sharepointService->find($id);
            
            return response()->json([
                'success' => true,
                'data' => $sharepoint,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Create sharepoint.
     *
     * @param  SharepointCreateRequest $request
     *
     * @return Response
     */
    public function store(SharepointCreateRequest $request) {
        
        try {
            
            $attributes = $request->all();
            $content = $request->file('file');
            
            $base64 = $request->has('base64') ? $request->get('base64') : false;
            
            $sharepoint = $this->sharepointService->upload($attributes, $content, $base64);
            
            $response = [
                'success' => true,
                'data' => $sharepoint,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on create request');
        }
    }
    
    /**
     * Update sharepoint.
     *
     * @param  SharepointUpdateRequest $request
     * @param  int                     $id
     *
     * @return Response
     */
    public function update(SharepointUpdateRequest $request, $id) {
        
        try {
            
            //Get attributes from request
            $attributes = $request->only(['virtual_path', 'name']);
            
            $updated = $this->sharepointService->update($id, $attributes);
            
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
     * Bulk update to sharepoints.
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            $id = $request->get('id');
            
            $updated = $this->sharepointService->update($id, $attributes);
            
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
     * Delete sharepoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->sharepointService->delete($id);
            
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
     * Bulk delete to sharepoints.
     *
     * @param  ModelBulkDeleteRequest $request
     *
     * @return Response
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->sharepointService->delete($request->get('id'));
            
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
     * Restore sharepoint.
     *
     * @param SharepointRestoreRequest $request
     * @param  int                     $id
     *
     * @return Response
     */
    public function restore(SharepointRestoreRequest $request, $id) {
        
        try {
            
            $path = $request->get('virtual_path');
            $restored = $this->sharepointService->restore($id, $path);
            
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
     * Bulk restore to sharepoints.
     *
     * @param  ModelBulkRestoreRequest $request
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->sharepointService->restore($request->get('id'), $request->only(['virtual_path', 'name']));
            
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
     * List sharepoints as option list.
     *
     * @param ListOptionsRequest $request
     *
     * @return Response
     */
    public function listAsOptions(ListOptionsRequest $request) {
        
        try {
            
            $sharepoints = $this->sharepointService->listAsOptions('id', 'id', 'filename');
            
            return response()->json([
                'success' => true,
                'data' => $sharepoints,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on list request');
        }
    }
    
    /**
     * Search & list sharepoints.
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
     *    **Condition example**: Search for (sharepoints with virtual_path ending in /documents)
     *    - virtual_path : '%/documents' : like
     *
     * @param SearchRequest $request
     * @return Response
     */
    public function search(SearchRequest $request) {
        
        try {
            
            $sharepoints = $this->sharepointService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $sharepoints,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
    
    
    //BUSSINESS LOGIC FUNCTION
    
    /**
     * Get sharepoints by path.
     *   It can flat or recursive (including subfolder files)
     *
     * @param  SharepointListRequest $request
     *
     * @return Response
     */
    public function listDirectory(SharepointListRequest $request) {
        
        try {
            
            $virtualPath = $request->get('virtual_path');
            $shared = $request->get('shared');
            $recursive = $request->get('recursive');
            
            $sharepoints = $this->sharepointService->list(auth()->id(), $virtualPath, $shared, $recursive);
            
            return response()->json([
                'success' => true,
                'data' => $sharepoints
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on list directory request');
        }
    }
    
    /**
     * Share file to user(s)
     *
     * @param SharepointShareRequest $request
     * @param                        $id
     *
     * @return mixed
     */
    public function share(SharepointShareRequest $request, $id) {
        
        try {
            
            $users = $request->get('users');
            $permission = $request->get('permission');
            
            $shared = $this->sharepointService->share($id, $users, $permission);
            
            return response()->json([
                'success' => true,
                'data' => $shared,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on share request');
        }
    }
    
    /**
     * Unshare file
     *
     * @param SharepointUnShareRequest $request
     * @param                          $id
     *
     * @return mixed
     * @throws \Exception
     */
    public function unshare(SharepointUnShareRequest $request, $id) {
        
        try {
            
            $users = $request->get('users');
            
            $unshared = $this->sharepointService->unshare($id, $users);
            
            return response()->json([
                'success' => true,
                'data' => $unshared,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            return $this->exceptionResponse($e, 'Exception occurred on unshare request');
        }
    }
    
    /**
     * Copy sharepoints to the specified virtual_path.
     *   Request parameters:
     *   - virtual_path: sharepoint new virtual_path
     *   - name (optional): sharepoint new name
     *
     * @param SharepointCopyRequest $request
     * @param int                   $id
     *
     * @return Response
     */
    public function copy(SharepointCopyRequest $request, $id) {
        
        try {
            
            $path = $request->get('virtual_path');
            $name = $request->get('name');
            $public = $request->get('public');
            
            $copied = $this->sharepointService->copy($id, $path, $name, $public);
            
            return response()->json([
                'success' => true,
                'data' => $copied,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on copy request');
        }
    }
    
    /**
     * Move sharepoints to the specified virtual_path.
     *   Request parameters:
     *   - virtual_path: sharepoint new virtual_path
     *   - name (optional): sharepoint new name
     *
     * @param SharepointMoveRequest $request
     * @param int                   $id
     *
     * @return mixed
     * @throws \Exception
     */
    public function move(SharepointMoveRequest $request, $id) {
        
        try {
            
            $path = $request->get('virtual_path');
            $name = $request->get('name');
            
            $moved = $this->sharepointService->move($id, $path, $name);
            
            return response()->json([
                'success' => true,
                'data' => $moved,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on move request');
        }
    }
}
