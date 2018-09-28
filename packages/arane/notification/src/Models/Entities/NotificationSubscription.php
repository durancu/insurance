<?php

namespace Arane\Notification\Models\Entities;


use Arane\Base\Models\Entities\User;
use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationSubscription.
 *
 * @package namespace Arane\Notification\Models\Entities;
 */
class NotificationSubscription extends Model {
    use ModelTrait;
    
    /**
     * @var string
     */
    protected $table = "notification_subscriptions";
    
    /**
     * @var array
     */
    protected $casts = [
        'email_subscribed' => 'boolean',
        'sms_subscribed' => 'boolean',
        'toast_subscribed' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    
    /**
     * @var array
     */
    protected $shown = ['id', 'user_id', 'channel_id'];
    
    /**
     * @return array
     */
    public function getShownAttribute(){
        return $this->shown;
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function channel(){
        return $this->hasOne(NotificationChannel::class, 'id', 'channel_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
