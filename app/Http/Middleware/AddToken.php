<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AddToken extends Middleware
{

    /**
     * Add JWT in header from cookies for web routes
     * @param Request $request
     * @param Closure $next
     * @param string[] ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->cookie('jwt_token') ?? "";
        $request->headers->set("Authorization", "Bearer $token");
        return $next($request);
    }
}
