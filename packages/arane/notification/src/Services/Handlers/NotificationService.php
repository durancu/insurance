<?php

namespace Arane\Notification\Services\Handlers;

use Arane\Base\Models\Entities\User;
use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\Log\Services\Handlers\LogService;
use Arane\Notification\Models\Entities\Notification;
use Arane\Notification\Services\Notifications\EmailNotification;
use Arane\Notification\Services\Notifications\SMSNotification;

use Illuminate\Support\Collection;


/**
 * Class NotificationService
 *
 * @package Arane\Base\Services\Handlers
 */
class NotificationService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    /**
     * @var LogService
     */
    protected $logService;
    
    /**
     * NotificationService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService, LogService $logService) {
        parent::__construct();
        
        $this->systemService = $systemService;
        $this->logService = $logService;
    }
    
    /**
     * Define NotificationService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return Notification::class;
    }
    
    /**
     * @param      array $data
     * @param      Collection $recipients
     * @param      User $sender
     * @return mixed
     */
    public function send($data, $recipients, $sender = null) {
        
        $recipients = collect($recipients);
        
        switch ($data['format']) {
            case   'sms':
            case 'email':
                
                $notification = ($data['format'] === 'sms') ? new SMSNotification($data['email']['message']) : new EmailNotification($data);
                
                foreach ($recipients as $recipient) {
                    $recipient->notify($notification);
                }
                
                $action = 'send ' . $data['format'];
                
                break;
            
            default:
                
                $notification = parent::create(['subject' => $data['email']['subject'], 'message'=> $data['email']['message']]);
                
                foreach ($recipients as $recipient) {
                    $notification->attachUser($recipient);
                }
                
                $action = 'send toast';
                
                break;
        }
        
        $recipientList = json_encode(array_column($recipients->toArray(), 'id'));
        
        $sender = isset($sender) ? $sender : $this->systemService->systemSuperAdmin();
        
        $this->logService->create([
            'user_id' => $sender->id, 'service' => 'notification', 'action' => $action . ' to ' . $recipientList,
            'result' => 'success',
            'message' => $data['format'] . ' notification sent for event: ' . $data['email']['message']
        ]);
        
        return $notification;
    }
    
    
}
