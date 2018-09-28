<?php

namespace Arane\Base\Services\Handlers;

use Arane\Base\Models\Entities\Role;



/**
 * Class RoleService
 *
 * @package Arane\Base\Services\Handlers
 */
class RoleService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * RoleService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define RoleService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return Role::class;
    }
    
    
}
