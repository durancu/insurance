<?php

namespace Arane\Email\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Email\Models\Entities\EmailType;


class EmailTypeService extends BaseModelService {
    
    /**
     * EmailTypeService constructor.
     *

     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Define EmailTypeService model
     *
     * @param  array $attributes
     *
     * @return string
     *
     */
    public function model() {
        return EmailType::class;
    }
}
