<?php

namespace Arane\Base\Services\Handlers;

use Arane\Base\Models\Entities\Role;
use Arane\Base\Models\Entities\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class SystemService
 *
 * @package Arane\Base\Services\Handlers
 */
class SystemService {
    
    /**
     * @var array
     */
    protected $notificationChannels = [
    ];
    
    /**
     * @var array
     */
    protected $channelTypes = ['email', 'sms', 'toast'];
    
    
    /**
     * SystemService constructor.
     */
    public function __construct() {
    }
    
    /**
     * Return Main SuperAdmin user
     *
     * @return mixed
     */
    public function systemSuperAdmin() {
        return User::find(config('settings.user.super-admin.user-id'));
    }
    
    /**
     * Return list of System Admin (super admins) users
     *
     * @return mixed
     */
    public function SystemAdmins() {
        return User::where('role_id', config('settings.user.admins.edge-role-id'))->get();
    }
    
    /**
     * Return currently authenticated user instance
     *
     * @return mixed
     */
    public function authUser() {
        return Auth::guard()->user();
    }
    
    /**
     * Return currently authenticated user id
     *
     * @return mixed
     */
    public function authUserId() {
        return Auth::guard()->id();
    }
    
    /**
     * Return now datetime
     *
     * @return Carbon
     */
    public function now() {
        //TODO: Implement Time Service or similar
        return Carbon::now();
    }
    
    /**
     * Return system notification channels
     *
     * @param $service
     * @return mixed
     */
    public function notificationChannels($service) {
        return $this->notificationChannels[$service];
    }
    
    /**
     * Return system notification channel types
     *
     * @return array
     */
    public function channelTypes() {
        return $this->channelTypes;
    }
    
    /**
     * Return system contact team
     *
     * @return mixed
     */
    public function contactTeam() {
        return $this->SystemAdmins();
    }
    
    /**
     * Return system standard user role
     *
     * @return mixed
     */
    public function standardUserRole() {
        $role = Role::where('name', 'user')->first();
        if (isset($role)) {
            return $role;
        }
        throw new ModelNotFoundException('Standard User role is not defined', 200);
    }
    
    /**
     * Return system account admin role
     *
     * @return mixed
     */
    public function accountAdminRole() {
        $role = Role::where('name', 'account-admin')->first();
        if (isset($role)) {
            return $role;
        }
        throw new ModelNotFoundException('Account Admin role is not defined', 200);
    }
    
    
}
