<?php

namespace Arane\File\Services\Controllers;


use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Requests\ListOptionsRequest;
use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Arane\File\Services\Requests\FileCopyRequest;
use Arane\File\Services\Requests\FileCreateRequest;
use Arane\File\Services\Requests\FileMoveRequest;
use Arane\File\Services\Requests\FileRestoreRequest;
use Arane\File\Services\Requests\FileUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Exception;
use Arane\File\Services\Handlers\FileService;

/**
 * Class FilesController.
 *
 * @package  namespace Arane\File\Services\Controllers;
 * @resource File: Files
 */
class FilesController extends BaseAPIController {
    
    /**
     * @var \Arane\File\Services\Handlers\FileService
     */
    protected $fileService;
    
    /**
     * FilesController constructor.
     *
     */
    public function __construct(FileService $fileService) {
        $this->fileService = $fileService;
    }
    
    /**
     * Get all files.
     *
     * @return Response
     */
    public function index() {
        
        try {
            
            $files = $this->fileService->search();
            
            return response()->json([
                'success' => true,
                'data' => $files,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Get a specific file.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $file = $this->fileService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $file,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Create file.
     *
     * @param  FileCreateRequest $request
     *
     * @return Response
     */
    public function store(FileCreateRequest $request) {
        
        try {
            
            $attributes = $request->all();
            $content = $request->file('file');
            
            $file = $this->fileService->create($attributes, $content);
            
            $response = [
                'success' => true,
                'data' => $file,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on create request');
        }
    }
    
    /**
     * Update file.
     *
     * @param  FileUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(FileUpdateRequest $request, $id) {
        
        try {
            
            //Get attributes from request
            $attributes = $request->only(['name', 'path', 'type']);
            
            $updated = $this->fileService->update($id, $attributes);
            
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
     * Bulk update to files.
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            
            $id = $request->get('id');
            
            $updated = $this->fileService->update($id, $attributes);
            
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
     * Delete file.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->fileService->delete($id);
            
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
     * Bulk delete to files.
     *
     * @param  ModelBulkDeleteRequest
     *
     * @return Response
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->fileService->delete($request->get('id'));
            
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
     * Restore file.
     *
     * @param  int               $id
     * @param FileRestoreRequest $request
     *
     * @return Response
     */
    public function restore(FileRestoreRequest $request, $id) {
        
        try {
            
            $path = $request->get('path');
            $restored = $this->fileService->restore($id, $path);
            
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
     * Bulk restore to files.
     *
     * @param  ModelBulkRestoreRequest $request
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->fileService->restore($request->get('id'));
            
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
     * Copy file to path.
     *   Request parameters:
     *    - path: file new path
     *    - name (optional): file new name
     *
     * @param FileCopyRequest $request
     * @param  int            $id
     *
     * @return Response
     */
    public function copy(FileCopyRequest $request, $id) {
        
        try {
            
            $toPath = $request->get('path');
            $newName = $request->get('name');
            $copied = $this->fileService->copy($id, $toPath, $newName);
            
            return response()->json([
                'success' => true,
                'data' => $copied,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on bulk restore request');
        }
    }
    
    /**
     * Moves file to path.
     *     *   Request parameters:
     *    - path: file new path
     *    - name (optional): file new name
     *
     * @param FileMoveRequest $request
     * @param  int            $id
     *
     * @return Response
     */
    public function move(FileMoveRequest $request, $id) {
        
        try {
            
            $toPath = $request->get('path');
            $newName = $request->get('name');
            $moved = $this->fileService->move($id, $toPath, $newName);
            
            return response()->json([
                'success' => true,
                'data' => $moved,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on bulk restore request');
        }
    }
    
    /**
     * Get files as option list.
     *
     * @param ListOptionsRequest $request
     *
     * @return Response
     */
    public function listAsOptions(ListOptionsRequest $request) {
        
        try {
            
            $files = $this->fileService->listAsOptions('id', 'id', 'display_name');
            
            return response()->json([
                'success' => true,
                'data' => $files,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on list request');
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
            
            $files = $this->fileService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $files,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
}
