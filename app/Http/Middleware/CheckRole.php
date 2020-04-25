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
    public function handle($request, Closure $next, $role)
    {

        if ( null !== auth()->user()  && auth()->user()->hasRole($role)) {
            // go on...
            return $next($request);
        }
        abort(401, 'The user is not authorized');

    }
}
