<?php

namespace Arane\Base\Services\Handlers;

use Arane\Base\Models\Entities\User;
use Arane\Base\Models\Entities\UserSetting;
use Arane\Base\Models\Traits\PassportToken;

/**
 * Class UserService
 *
 * @package Arane\Base\Services\Handlers
 */
class UserService extends BaseModelService {
    
    //use PassportToken;
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    
    /**
     * UserService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define UserService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return User::class;
    }
    
    /**
     * Set default settings to a user
     *
     * @param $user
     */
    public function assignDefaultSettings($user) {
        if (!$user->settings) {
            UserSetting::create(['user_id' => $user->id]);
        }
    }
    
    /**
     * Assign default role to a user
     *
     * @param $user
     */
    public function assignDefaultRole($user) {
        $user = User::find($user->id);
        $user->role_id = $this->systemService->standardUserRole()->id;
        $user->save();
    }
    
    
}
