<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $c_role = [])
    {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
        if ($roles == null) {
            $roles = $c_role;
        }
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if ($request->user()->hasRole($roles) || !$roles) {
            return $next($request);
        }

        // Laravel 11 Fix: Prevent infinite redirect loop
        // Show 403 page instead of redirecting
        return response(view('403'), 403);
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();

        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
