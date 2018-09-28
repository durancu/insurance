<?php

namespace Arane\Base\Services\Controllers;

use Arane\Base\Services\Handlers\CountryService;
use Arane\Base\Services\Handlers\StateService;
use Arane\Base\Services\Requests\PublicCountriesRequest;
use Arane\Base\Services\Requests\PublicStatesRequest;
use Illuminate\Http\Response;
use Exception;
use Arane\Base\Services\Handlers\SystemService;

/**
 * Class SystemsController.
 *
 * @package namespace Arane\Base\Services\Controllers;
 * @resource Public
 */
class PublicController extends BaseAPIController {
    
    protected $systemService;
    protected $countryService;
    protected $stateService;
    
    /**
     * SystemsController constructor.
     *
     */
    public function __construct(SystemService $systemService, CountryService $countryService, StateService $stateService) {
        $this->systemService = $systemService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
    }
    
    /**
     * List all US States
     *
     * @param PublicStatesRequest $request
     * @return Response
     */
    public function states(PublicStatesRequest $request) {
        
        try {
    
            if ($request->has('format') && $request->get('format') == 'options') {
        
                $data = $this->stateService->listAsOptions('id', 'id', 'name');
        
            } else {
        
                $data = $this->countryService->search(['no-paginate' => true]);
            }
            
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
    
        } catch (Exception $e) {
    
            return $this->exceptionResponse($e, 'Exception occurred on list states request');
        }
    }
    
    /**
     * List all World Countries
     *
     * @param PublicCountriesRequest $request
     * @return Response
     */
    public function countries(PublicCountriesRequest $request) {
        
        try {
            
            if ($request->has('format') && $request->get('format') == 'options') {
                
                $data = $this->countryService->listAsOptions('id', 'id', 'nice_name');
                
            } else {
                
                $data = $this->countryService->search(['no-paginate' => true]);
            }
            
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
            
        } catch (Exception $e) {
    
            return $this->exceptionResponse($e, 'Exception occurred on list countries request');
        }
    }
    
}
