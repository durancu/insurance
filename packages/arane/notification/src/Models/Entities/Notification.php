<?php

namespace Arane\Notification\Models\Entities;

use Arane\Base\Models\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Notification
 *
 * @package Arane\Notification\Models\Entities
 */

class Notification extends Model {
    
    use SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'notifications';
    
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * @var array
     */
    protected $fillable = ['subject', 'message'];
    
    /**
     * @var array
     */
    protected $shown = ['id'];
    
    /**
     * @return array
     */
    public function getShownAttribute() {
        return $this->shown;
    }
    
    /**
     * Notification constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }
    
    /**
     * Many-to-Many relations with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany(User::class, 'user_notification')->withTimestamps();
    }
    
    /**
     * @param $users
     */
    public function attachUser($users) {
        if (is_array($users)) {
            foreach ($users as $user) {
                $this->users()->attach($user->id);
            }
        } else {
            $this->users()->attach($users->id);
        }
    }
}
