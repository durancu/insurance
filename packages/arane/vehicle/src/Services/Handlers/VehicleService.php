<?php

namespace Arane\Vehicle\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\Vehicle\Models\Entities\Vehicle;



/**
 * Class VehicleService
 *
 * @package Arane\Base\Services\Handlers
 */
class VehicleService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * VehicleService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define VehicleService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return Vehicle::class;
    }
    
    
}
