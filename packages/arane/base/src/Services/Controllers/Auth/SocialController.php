<?php

namespace Arane\Base\Services\Controllers\Auth;

use Arane\Base\Models\Entities\User;
use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Handlers\AuthService;
use Arane\Base\Services\Transformers\SocialUserTransformer;
use Arane\Base\Models\Traits\PassportToken;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use Exception;

/**
 * Class SocialController
 *
 * @package  Arane\Base\Services\Controllers\Auth
 * @resource Auth
 */
class SocialController extends BaseAPIController {
    
    use PassportToken;
    
    /**
     * @var AuthService
     */
    protected $authService;
    
    /**
     * SocialController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }
    
    /**
     * Get OAuth provider redirection url (to login in the external application)
     *
     * @param $provider
     * @return Response
     */
    public function redirectToProvider($provider) {
        $providerKey = config('services.' . $provider);
        
        if (empty($providerKey)) {
            return response()->json([
                'message' => 'Invalid identity provider'
            ], 401);
        }
        
        if (request()->wantsJson()) {
            return Socialite::with($provider)->stateless()->redirect()->getTargetUrl();
        }
        
        return Socialite::with($provider)->redirect();
    }
    
    /**
     * Handle OAuth provider authentication response
     *
     * @param $provider
     * @return Response | RedirectResponse
     */
    public function handleProviderCallback($provider) {
        
        try {
            
            if (Input::get('denied') != '') {
                return redirect()->to('login')
                    ->with('status', 'danger')
                    ->with('success', 'You didn\'t share your profile data with us.');
            }
            
            //Get user data from provider
            $socialUser = request()->wantsJson() ? Socialite::with($provider)->stateless()->user() : Socialite::driver($provider)->user();
            
            if (!isset($socialUser->email)) {
                return response()->json([
                    'success' => false,
                    'data' => 'Could not retrieve email address from oauth provider'
                ]);
            }
            
            $user = User::where('email', $socialUser->email)->first();
            
            if (!$user) {
                $transformer = new SocialUserTransformer($socialUser);
                $attributes = $transformer->transform($provider);
                
                $userData = $this->authService->register($attributes, 'api', true);
                
            } else {
                $userData = $this->authService->logUserIn($user);
            }
            
            return response()->json([
                'success' => true,
                'data' => $userData
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on social login request');
        }
    }
    
}
