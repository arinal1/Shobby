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
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $isAuthorized = false;
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                $isAuthorized = true;
                break;
            }
        }
        if ($isAuthorized) return $next($request);
        else abort(401, 'This action is unauthorized.');
    }
}
