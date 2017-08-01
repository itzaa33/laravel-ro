<?php

namespace App\Http\Middleware;

use Closure;

class check_mod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

            $usertable = $request->user();

            if($usertable->rank != 'User')
            {
              return $next($request);
            }
            else
              return redirect('/home');
    }
}
