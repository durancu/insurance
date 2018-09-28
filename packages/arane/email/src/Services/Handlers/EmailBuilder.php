<?php

namespace Arane\Email\Services\Handlers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailBuilder extends Mailable implements ShouldQueue {
    use Queueable, SerializesModels;
    
    protected $emailData;
    protected $messageData;
    protected $options;
    
    /**
     * Create a new message instance.
     *
     * @param  array $emailData : [from, to, cc, bcc, reply-to, subject, priority, attachments]
     * @param  array $messageData
     * @param  array $options
     *
     * @return void
     */
    public function __construct($emailData, $messageData, $options) {
        $this->emailData = $emailData;
        $this->messageData = $messageData;
        $this->options = $options;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build() {
        
        //Required fields
        $this->to($this->emailData['to']);
        $this->subject($this->emailData['subject']);
        
        //Other fields
        $fromAddress = isset($this->emailData['from-address']) ? $this->emailData['from-address'] : config('mail.from.address');
        $fromName = isset($this->emailData['from-name']) ? $this->emailData['from-name'] : config('mail.from.name');
        $this->from($fromAddress, $fromName);
        
        $this->cc(isset($this->emailData['cc']) ? $this->emailData['cc'] : []);
        $this->bcc(isset($this->emailData['bcc']) ? $this->emailData['bcc'] : []);
        $this->replyTo(isset($this->emailData['reply-to']) ? $this->emailData['reply-to'] : $fromAddress, isset($this->emailData['reply-to']) ? '' : $fromName);
        
        if (isset($this->emailData['attachments']) && count($this->emailData['attachments'])) {
            foreach ($this->emailData['attachments'] as $attachment) {
                if (is_string($attachment)) {
                    $this->attach($attachment, []);
                } elseif (is_array($attachment)) {
                    $options = isset($attachment['options']) ? $attachment['options'] : [];
                    if (isset($attachment['path'])) {
                        $this->attach($attachment['path'], $options);
                    }
                }
            }
        }
        
        $format = isset($this->options['format']) ? $this->options['format'] : 'markdown';
        $viewPath = isset($this->options['view']) ? $this->options['view'] : config('arane.default-view');
        
        $view = ($format === 'text') ? ['text' => $viewPath] : $viewPath;
        
        $this->view($view);
        
        $this->priority(isset($this->options['priority']) ? $this->options['priority'] : config('arane-email.priority'));
        
        return $this;
    }
}
