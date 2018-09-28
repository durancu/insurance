<?php

namespace Arane\Notification\Models\Entities;

use Arane\Base\Models\Entities\User;
use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationChannel.
 *
 * @package namespace Arane\Notification\Models\Entities;
 */
class NotificationChannel extends Model {
    use ModelTrait;
    
    /**
     * @var string
     */
    protected $table = 'notification_channels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    
    /**
     * @var array
     */
    protected $shown = ['id'];
    
    /**
     * @return array
     */
    public function getShownAttribute(){
        return $this->shown;
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class, 'notification_subscription', 'channel_id', 'user_id')->withTimestamps();
    }

}
