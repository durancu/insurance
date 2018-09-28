<?php

namespace Arane\Base\Services\Handlers;

use Arane\Base\Models\Entities\Country;

/**
 * Class CountryService.
 *
 * @package namespace Arane\Base\Services\Handlers;
 */
class CountryService extends BaseModelService {
    
    /**
     * CountryService constructor.
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
        return Country::class;
    }
    
}
