<?php

namespace Arane\Log\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\Log\Models\Entities\Log;



/**
 * Class LogService
 *
 * @package Arane\Base\Services\Handlers
 */
class LogService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * LogService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define LogService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return Log::class;
    }
    
    
}
