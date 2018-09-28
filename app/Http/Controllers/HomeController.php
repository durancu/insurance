<?php

namespace App\Http\Controllers;

use Arane\Base\Services\Handlers\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    protected $userService;
    
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        return view('site.layouts.app');
    
    }

}
