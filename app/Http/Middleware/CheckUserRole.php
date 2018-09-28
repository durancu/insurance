<?php

namespace App\Http\Middleware;

use Arane\Base\Models\Entities\Role;
use Arane\Base\Models\Entities\User;
use Closure;

class CheckUserRole {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role) {
        
        if (auth()->check()) {
            
            $user = User::find(auth()->id());
            $role = Role::where('name', $role)->first();
            
            if (isset($user) && isset($role)) {
                
                if ($user->role->id <= $role->id) {
                    return $next($request);
                }
            }
        }
        
        
        return response()->json([
            'success'=>  false,
            'data' => 'Insufficient user role to access this route'
        ], 200);
        
    }
}
