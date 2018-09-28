<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Arane\Base\Services\Handlers\AuthService;
use Arane\Base\Services\Handlers\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
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
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';
    
    protected $userService;
    protected $authService;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, AuthService $authService) {
        $this->middleware('guest');
        
        $this->userService = $userService;
        $this->authService = $authService;
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }
    
    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function showRegistrationForm() {
        return view('site.sign-up');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  Request $request
     * @return Response
     */
    public function register(Request $request) {
        
        try {
            
            $errors=[];
            if (count($this->validator($request->all())->errors())) {
                return redirect('register')->withErrors($this->validator($request->all())->errors());
            }
            
            
            if (count($errors)) {
                toastr()->error('An error has occurred please try again later.');
                
                return redirect('register');
            }
            
            $this->authService->register($request->all(), 'web', 'true');
            
            toastr()->success('User has been registered successfully!');
            
            return redirect('account');
            
        } catch (\Exception $exception) {
            toastr()->error('An error has occurred please try again later.');
            
            return back(302);
        }
    }
    
    
}
