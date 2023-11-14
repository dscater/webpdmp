<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permiso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permiso)
    {
        $auth = Auth::user();
        if ($auth->hasPermiso($permiso)) {
            return $next($request);
        }
        abort(401);
    }
}
