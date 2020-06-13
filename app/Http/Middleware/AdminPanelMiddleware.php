<?php

namespace App\Http\Middleware;

use Closure;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->is_admin || !auth()->user()->is_manager) {
            abort(404);
        }

        return $next($request);
    }
}
