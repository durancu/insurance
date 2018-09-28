<?php


namespace Arane\Email\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Email\Models\Entities\EmailList;


class EmailListService extends BaseModelService {
    
    /**
     * DocumentFieldService constructor.
     *

     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Define DocumentFieldService model
     *
     * @param  array $attributes
     *
     * @return string
     *
     */
    public function model() {
        return EmailList::class;
    }
}
