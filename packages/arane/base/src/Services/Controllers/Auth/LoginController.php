<?php

namespace Arane\Base\Services\Controllers\Auth;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Handlers\AuthService;
use Arane\Base\Services\Requests\TokenRefreshRequest;
use Arane\Base\Services\Requests\UserLoginRequest;
use Arane\Base\Models\Traits\PassportToken;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Exception;
use Illuminate\Http\Response;

/**
 * Class LoginController
 *
 * @package  Arane\Base\Services\Controllers\Auth
 * @resource Auth
 * @author ARANE Consulting LLC
 */
class LoginController extends BaseAPIController {
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    use PassportToken;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    /**
     * @var AuthService
     */
    protected $authService;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService) {
        $this->middleware('guest', ['except' => ['logout', 'getLogout', 'me']]);
        
        $this->authService = $authService;
    }
    
    
    /**
     *  Log user into the application.
     *
     * @return Response
     */
    public function login(UserLoginRequest $request) {
        
        try {
            
            $userData = $this->authService->login($request->only(['email', 'password']));
            
            if (!$userData) {
                return response()->json([
                    'success' => false,
                    'data' => 'Invalid email and/or password'
                ], 200);
            }
            
            return response()->json([
                'success' => true,
                'data' => $userData
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on login request', 200);
        }
    }
    
    /**
     * Log the user out of the application (using GET method).
     *
     * @return Response
     */
    public function getLogout() {
        
        try {
            
            $this->authService->logout();
            //Revoke auth api token
            if (request()->user()) {
                request()->user()->token()->revoke();
            }
            
            return response()->json([
                'success' => true,
                'data' => []
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on logout request', 200);
        }
    }
    
    /**
     * Show the authenticated user.
     *
     * @return Response
     */
    public function me() {
        try {
            return response()->json([
                'success' => true,
                'data' => $this->authService->authUser()
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on get my user request', 200);
        }
    }
    
    /**
     * Refresh user OAuth (Bearer) token.
     *
     * @return Response
     */
    public function refresh(TokenRefreshRequest $request) {
        
        try {
            
            $credentials = $request->only('refresh_token', 'client_id', 'client_secret', 'scope');
            
            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $this->authService->refreshToken($credentials)
                ]
            ]);
            
        } catch (Exception $e) {
            
            return $this->exceptionResponse($e, 'Exception occurred on refresh token request', 200);
        }
    }
    
}
