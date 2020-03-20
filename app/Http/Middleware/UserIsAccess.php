<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() == false) {
            return $next($request);
        } else {
            if (auth()->user()->state == 0) {
                abort(403, "Votre compte à été désactivée ou vous n'avez pas accès à cette partie du site");
            }
            return $next($request);
        }
    }
}
