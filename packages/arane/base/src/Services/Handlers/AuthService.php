<?php

namespace Arane\Base\Services\Handlers;

use Arane\Base\Events\UserRegisteredEvent;
use Arane\Base\Models\Entities\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Arane\Base\Models\Traits\PassportToken;


/**
 * Class AuthService
 *
 * @package Arane\Base\Services\Handlers
 */
class AuthService {
    
    use PassportToken;
    
    /**
     * @var UserService
     */
    protected $userService;
    
    
    /**
     * AuthService constructor.
     *
     * @param SystemService $systemService
     * @param UserService   $userService
     */
    public function __construct(SystemService $systemService, UserService $userService) {
        
        $this->systemService = $systemService;
        $this->userService = $userService;
    }
    
    
    /**
     * Log user in the system
     *
     * @param $credentials
     * @return array|bool
     */
    public function login($credentials) {
        
        //Try log user in the system using credentials
        if (auth()->guard()->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            
            //Look for the user
            $user = User::where('email', $credentials['email'])->first();
            
            //Set default settings to user if doesn't have them
            if (!$user->settings) {
                $this->userService->assignDefaultSettings($user);
            }
            
            //Get user bearer token
            $token = $this->getBearerTokenByUser($user, config('services.arane-oauth-personal.key'), false);
            
            
            return [
                'user' => $user,
                'token' => $token,
                'menu_items' => $user->menuItems
            ];
            
        }
        
        return false;
    }
    
    /**
     * Log user in the system
     *
     * @param $credentials
     * @return array|bool
     */
    public function logUserIn(User $user) {
        
        //Look for the user
        $user = User::find($user->id);
        
        if (isset($user)) {
            auth()->login($user);
            
            //Set default settings to user if doesn't have them
            if (!$user->settings) {
                $this->userService->assignDefaultSettings($user);
            }
            
            //Get user bearer token
            $token = $this->getBearerTokenByUser($user, config('services.arane-oauth-personal.key'), false);
            
            
            return [
                'user' => $user,
                'token' => $token,
                'menu_items' => $user->menuItems
            ];
        }
        
        
        return false;
    }
    
    /**
     * Log user out the system
     *
     * @return bool
     */
    public function logout() {
        
        //Close web session
        auth()->guard('web')->logout();
        
        return true;
    }
    
    /**
     * Get authenticated user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function authUser() {
        return auth()->user();
    }
    
    
    /**
     * Register a new user
     *
     * @param $attributes
     * @param $includeLogin
     * @param $source (api, admin)
     * @return mixed
     */
    public function register($attributes, $source = 'api', $includeLogin = false) {
        
        $attributes['role_id'] = ($source != 'admin') || ($source == 'admin' && !isset($attributes['role_id'])) ? $this->systemService->standardUserRole()->id : $attributes['role_id'];
        
        $user = $this->userService->create($attributes);
        
        $user->password = bcrypt($attributes['password']);
        $user->save();
        
        try {
            
            Event::fire(new UserRegisteredEvent($user));
            
            //TODO: Send notification about successful email
            $notified = true;
            
        } catch (\Exception $e) {
            
            #TODO: Send notification to admin about email service issue
            $notified = false;
        }
        
        if ($includeLogin) {
            return $this->login(['email' => $attributes['email'], 'password' => $attributes['password']]);
        }
        
        return $user;
    }
    
    
    /**
     * Refresh user bearer token
     *
     * @param $credentials
     * @return mixed
     */
    public function refreshToken($credentials) {
        
        $http = new Client();
        
        $response = $http->post(config('app.url') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $credentials['refresh_token'],
                'client_id' => isset($credentials['client_id']) ? $credentials['client_id'] : config('services.arane-oauth-personal.key'),
                'client_secret' => isset($credentials['client_secret']) ? $credentials['client_secret'] : config('settings.socialite.clients.personal.web.secret'),
                'scope' => isset($credentials['scope']) ? $credentials['scope'] : ''
            ],
        ]);
        
        $token = json_decode($response->getBody()->getContents());
        
        return $token;
    }
    
    
}
