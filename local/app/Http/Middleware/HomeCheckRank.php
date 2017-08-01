<?php

namespace App\Http\Middleware;

use Closure;

class HomeCheckRank
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

            if($usertable->rank == 'Admin')
            {
              return redirect('admin_home');
            }
            elseif($usertable->rank == 'Mod')
            {
                return $next($request);
            }
            elseif($usertable->rank == 'User')
            {
                return $next($request);
            }

            else
              return redirect('login');
    }
}
