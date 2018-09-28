<?php

namespace App\Http\Middleware;

use Closure;

class PremiumSubscription {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!auth()->user()->subscribedToPlan('premium', 'main')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }
            return redirect('/user/plans');
        }

        return $next($request);
    }
}
