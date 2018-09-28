<?php

namespace Arane\Notification\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\Notification\Models\Entities\NotificationChannel;



/**
 * Class NotificationChannelService
 *
 * @package Arane\Notification\Services\Handlers
 */
class NotificationChannelService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * NotificationChannelService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define NotificationChannelService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return NotificationChannel::class;
    }
    
    
}
