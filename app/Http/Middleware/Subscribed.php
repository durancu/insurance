<?php

namespace App\Http\Middleware;

use Closure;

class Subscribed {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!auth()->user()->subscribed('main')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }
            return redirect()->back()->with('error','User is not subscribed. Unauthorized content.');
        }

        return $next($request);
    }
}
