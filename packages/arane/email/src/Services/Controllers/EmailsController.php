<?php

namespace Arane\Email\Services\Controllers;

use App\Notifications\ContactMessage;
use App\Notifications\ContactMessageResponse;
use Arane\Base\Models\Entities\User;
use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Handlers\SystemService;
use Arane\Email\Services\Handlers\EmailService;
use Arane\Email\Services\Requests\EmailContactSendRequest;
use Arane\Email\Services\Requests\EmailSendRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Exception;

/**
 * Class EmailsController
 *
 * @package  Arane\Email\Services\Controllers
 * @resource Email: Emails
 */
class EmailsController extends BaseAPIController {
    
    /**
     * @var EmailService
     */
    protected $emailService;
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * Construct Email API Controller.
     *
     * @param  EmailService $emailService
     *
     */
    public function __construct(EmailService $emailService, SystemService $systemService) {
        $this->emailService = $emailService;
        $this->systemService = $systemService;
    }
    
    /**
     * Send an email.
     *
     * @param  EmailSendRequest $request
     *
     * @return Response
     */
    public function send(EmailSendRequest $request) {
        
        //TODO: Check email field can be empty or not (email[to] is required)
        $emailData = $request->has('email') ? $request->get('email') : [];
        $messageData = $request->has('message') ? $request->get('message') : [];
        $options = $request->has('options') ? $request->get('options') : [];
        
        $email = $this->emailService->send($emailData, $messageData, $options);
        
        return response()->json([
                'success' => true,
                'data' => $email
            ]
        );
        
    }
    
    /**
     * Send contact message
     *
     * @param EmailContactSendRequest $request
     * @return Response
     */
    public function sendContactMessage(EmailContactSendRequest $request) {
        
        try {
            $fromEmail = $request->get('from-email');
            $fromName = $request->get('from-name');
            $subject = $request->get('subject');
            $message = $request->get('message');
            $reason = $request->has('reason') ? $request->get('reason') : 'General contact';
            $attachment = $request->hasFile('attachment') ? $request->file('attachment') : null;
            
            $recipients = $this->systemService->contactTeam();
            
            foreach ($recipients as $recipient) {
                $user = User::find($recipient->id);
                $user->notify(new ContactMessage($fromName, $fromEmail, $subject, $message, $reason, $attachment));
            }
            
            Notification::route('mail', $fromEmail)->notify(new ContactMessageResponse());
            
            if ($request->has('phone-number')) {
                Notification::route('sns', $request->get('phone-number'))->notify(new ContactMessageResponse());
            }
            
            return response()->json([
                'success' => true,
                'data' => []
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on search request');
        }
        
    }
    
}
