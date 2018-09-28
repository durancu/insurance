<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Arane\Log\Models\Entities\Log;
use Arane\Notification\Models\Entities\NotificationChannel;
use Arane\Sharepoint\Models\Entities\Sharepoint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Passport\HasApiTokens;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
    
    use ModelTrait;
    use HasApiTokens;
    use Authenticatable, CanResetPassword, Notifiable;
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['email', 'password', 'first_name', 'last_name', 'phone_number', 'role_id'];
    
    protected static $searchable = ['id', 'email' => 'like', 'first_name' => 'like', 'last_name' => 'like', 'phone_number' => 'like'];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    protected $shown = ['id', 'role_id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
    
    public static function searchableFields() {
        return self::$searchable;
    }
    
    public function homeUrl() {
        if ($this->hasRole('user')) {
            $url = route('user.home');
        } else {
            $url = route('admin.home');
        }
        
        return $url;
    }
    
    /**
     * Route notifications for the Aws SNS SMS channel.
     *
     * @return string
     */
    public function routeNotificationForAwsSnsSms() {
        return $this->phone_number;
    }
    
    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
    
    public function isSuperAdmin() {
        return $this->role_id === 1;
    }
    
    public function isAdmin() {
        return $this->role_id <= 2;
    }
    
    public static function defaultTransformer($attributes) {
        $result = [];
        foreach (static::fillableFields() as $field) {
            $result[$field] = (isset($attributes[$field])) ? ($attributes[$field]) : null;
        }
        
        return $result;
    }
    
    public function logs() {
        return $this->hasMany(Log::class, 'user_id');
    }
    
    public function settings() {
        return $this->hasOne(UserSetting::class, 'user_id');
    }
    
    public function notificationSubscriptions() {
        return $this->belongsToMany(NotificationChannel::class, 'notification_subscriptions', 'user_id', 'channel_id')->withTimestamps();
    }
    
    public function sharepoints() {
        return $this->hasMany(Sharepoint::class);
    }
    
    public function getMenuItemsAttribute() {
        return MenuItem::where('roles', 'like', '%\"' . $this->role->name . '\"%')->get();
    }
    
    
    /**
     * Return default User Role.
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Check if User has a Role(s) associated.
     *
     * @param string|array $name The role(s) to check.
     *
     * @return bool
     */
    public function hasRole($name) {
        return strcmp($this->role->name, $name) === 0;
    }
    
    /**
     * Set default User Role.
     *
     * @param string $name The role name to associate.
     */
    public function setRole($name) {
        $role = Role::where('name', $name)->first();
        if ($role) {
            $this->role()->associate($role);
            $this->save();
        }
        
        return $this;
    }
    
    public function permissions() {
        return $this->role->permissions();
    }
    
    
    public function hasPermission($name) {
        $permission = Permission::where('key', $name)->first();
        if (isset($permission)) {
            $userPermission = $this->permissions()->find($permission->id);
            
            return isset($userPermission);
        }
        
        return false;
    }
    
    
}
