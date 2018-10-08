<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class DashboardMiddleware
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
        if (auth()->user()->adminRole(Role::ADMIN_ROLE_SLUG)->count() <= 0) {
            return abort(404);
        };

        return $next($request);
    }
}
