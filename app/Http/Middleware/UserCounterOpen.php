<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserCounterOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        !Redis::exists('user:'.Auth::user()->id) ? Redis::set("user:".Auth::user()->id, 0) : Redis::incr('user:'.Auth::user()->id);

        return $next($request);
    }
}
