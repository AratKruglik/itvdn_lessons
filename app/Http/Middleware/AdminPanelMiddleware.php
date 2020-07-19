<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {
        if (!auth()->user()->is_admin || !auth()->user()->is_manager) {
            abort(404);
        }

        return $next($request);
    }
}
