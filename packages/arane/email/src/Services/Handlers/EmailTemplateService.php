<?php
namespace Arane\Email\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Email\Models\Entities\EmailTemplate;


class EmailTemplateService extends BaseModelService {
    
    /**
     * EmailTemplateService constructor.
     *

     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Define EmailTemplateService model
     *
     * @param  array $attributes
     *
     * @return string
     *
     */
    public function model() {
        return EmailTemplate::class;
    }
}
