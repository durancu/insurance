<?php

namespace Arane\Base\Services\Handlers;

use Arane\Base\Models\Entities\State;

/**
 * Class StateService.
 *
 * @package namespace Arane\Base\Services\Handlers;
 */
class StateService extends BaseModelService {
    
    /**
     * StateService constructor.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Define Service model.
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return State::class;
    }
    
    
}
