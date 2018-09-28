<?php

namespace App\Http\Middleware;

use Arane\Base\Models\Entities\Permission;
use Arane\Base\Models\Entities\Role;
use Arane\Base\Models\Entities\User;
use Closure;

class CheckUserPermission {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission) {
        
        if (auth()->check()) {
            
            $user = User::find(auth()->id());
            
            if (isset($user) && $user->hasPermission($permission)) {
                
                    return $next($request);
            }
        }
        
        
        return response()->json([
            'success'=>  false,
            'data' => 'Insufficient permissions to access this route'
        ], 200);
        
    }
}
