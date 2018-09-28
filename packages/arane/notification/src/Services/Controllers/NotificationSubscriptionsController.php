<?php

namespace Arane\Notification\Services\Controllers;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Requests\ModelBulkDeleteRequest;
use Arane\Base\Services\Requests\ModelBulkRestoreRequest;
use Arane\Base\Services\Requests\ModelBulkUpdateRequest;
use Arane\Base\Services\Requests\SearchRequest;
use Arane\Notification\Services\Requests\NotificationSubscriptionCreateRequest;
use Arane\Notification\Services\Requests\NotificationSubscriptionUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Exception;
use Arane\Notification\Services\Handlers\NotificationSubscriptionService;

/**
 * Class NotificationSubscriptionsController.
 *
 * @package namespace Arane\Notification\Services\Controllers;
 * @resource Notification: Subscriptions
 */
class NotificationSubscriptionsController extends BaseAPIController {
    
    /**
     * @var NotificationSubscriptionService
     */
    protected $notificationSubscriptionService;
    
    /**
     * NotificationSubscriptionsController constructor.
     *
     */
    public function __construct(NotificationSubscriptionService $notificationSubscriptionService) {
        $this->notificationSubscriptionService = $notificationSubscriptionService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        try {
            $notificationSubscriptions = $this->notificationSubscriptionService->search();
            
            
            return response()->json([
                'success' => true,
                'data' => $notificationSubscriptions,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on index request');
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  NotificationSubscriptionCreateRequest $request
     *
     * @return Response
     */
    public function store(NotificationSubscriptionCreateRequest $request) {
        
        try {
            
            $notificationSubscription = $this->notificationSubscriptionService->create($request->all());
            
            $response = [
                'success' => true,
                'data' => $notificationSubscription,
            ];
            
            return response()->json($response);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on create request');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
        try {
            
            $notificationSubscription = $this->notificationSubscriptionService->find($id);;
            
            return response()->json([
                'success' => true,
                'data' => $notificationSubscription,
            ]);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->exceptionResponse($e, 'Model not found exception', 200);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get item request');
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  NotificationSubscriptionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(NotificationSubscriptionUpdateRequest $request, $id) {
        
        try {
            
            $updated = $this->notificationSubscriptionService->update($id, $request->all());
            
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
     * Update the specified resource in storage.
     *
     * @param  ModelBulkUpdateRequest $request
     *
     * @return Response
     */
    public function bulkUpdate(ModelBulkUpdateRequest $request) {
        
        try {
            
            $attributes = $request->get('attributes');
            $id = $request->get('id');
            
            $updated = $this->notificationSubscriptionService->update($id, $attributes);
            
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        
        try {
            
            $deleted = $this->notificationSubscriptionService->delete($id);
            
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
     * Bulk remove the specified resources.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkDestroy(ModelBulkDeleteRequest $request) {
        
        try {
            
            $deleted = $this->notificationSubscriptionService->delete($request->get('id'));
            
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
     * Restore the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function restore($id) {
        
        try {
            
            $restored = $this->notificationSubscriptionService->restore($id);
            
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
     * Bulk restore the specified resources.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function bulkRestore(ModelBulkRestoreRequest $request) {
        
        try {
            
            $restored = $this->notificationSubscriptionService->restore($request->get('id'));
            
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function listAsOptions() {
        
        try {
            
            $notificationSubscriptions = $this->notificationSubscriptionService->listAsOptions('id', 'id', 'display_name');
            
            return response()->json([
                'success' => true,
                'data' => $notificationSubscriptions,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on list request');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function search(SearchRequest $request) {
        
        try {
            
            $notificationSubscriptions = $this->notificationSubscriptionService->search($request->all());
            
            return response()->json([
                'success' => true,
                'data' => $notificationSubscriptions,
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
    }
}
