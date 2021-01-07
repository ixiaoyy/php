<?php

namespace App\middleware;

class WebMiddleWare
{
    public function handle($request,\Closure $next)
    {
        return $next($request);
    }
}