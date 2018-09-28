<?php

namespace Arane\Base\Services\Controllers\Auth;

use Arane\Base\Services\Controllers\BaseAPIController;
use Arane\Base\Services\Handlers\AuthService;
use Arane\Base\Services\Requests\UserRegisterRequest;
use Arane\Base\Models\Traits\PassportToken;
use Illuminate\Foundation\Auth\RegistersUsers;
use Exception;

/**
 * Class RegisterController
 *
 * @package Arane\Base\Services\Controllers\Auth
 * @resource Auth
 * @author ARANE Consulting LLC
 */
class RegisterController extends BaseAPIController {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;
    use PassportToken;
    
    /**
     * Where to redirect users after registration.
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
        
        $this->middleware('guest');
        $this->authService = $authService;
    }
    
    /**
     * Register new user in the application
     *
     * @return \Arane\Base\Models\Entities\User
     */
    public function register(UserRegisterRequest $request) {
        
        try {
            
            //Get user attributes from request
            $attributes = $request->only('email', 'password', 'role_id', 'first_name', 'last_name', 'phone_number');
            
            //Get request source: admin, api, etc..
            $source = $request->get('source');
            
            //Get whether request includes to log the user in after register
            $includeLogin = $request->get('includeLogin');
            
            return response()->json([
                'success' => true,
                'data' => $this->authService->register($attributes, $source, $includeLogin)
            ], 201);
    
        } catch (Exception $e) {
    
            return $this->exceptionResponse($e, 'Exception occurred on register new user request');
        }
    }
}
