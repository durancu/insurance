<?php

namespace Arane\Notification\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\Notification\Models\Entities\NotificationSubscription;



/**
 * Class NotificationSubscriptionService
 *
 * @package Arane\Notification\Services\Handlers
 */
class NotificationSubscriptionService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * NotificationSubscriptionService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define NotificationSubscriptionService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return NotificationSubscription::class;
    }
    
    
}
