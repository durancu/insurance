<?php

namespace Arane\Base\Services\Handlers;

use Arane\Base\Models\Entities\Permission;
use Arane\Base\Models\Traits\PassportToken;



/**
 * Class PermissionService
 *
 * @package Arane\Base\Services\Handlers
 */
class PermissionService extends BaseModelService {
    
    use PassportToken;
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * PermissionService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define PermissionService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return Permission::class;
    }
    
    
}
