<?php

namespace Modules\Auth\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class BlockUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user->status) {
            return redirect()->route('clients.block.index');
        }
        return $next($request);
    }
}