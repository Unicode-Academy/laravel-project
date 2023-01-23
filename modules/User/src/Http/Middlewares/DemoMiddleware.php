<?php

namespace Modules\User\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class DemoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        echo "Demo Middleware";

        return $next($request);
    }
}