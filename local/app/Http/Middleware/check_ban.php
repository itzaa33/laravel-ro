<?php

namespace App\Http\Middleware;

use Closure;

class check_ban
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

      if($usertable->status_ban == '0')
      {
        return $next($request);
      }
      else
        return redirect('/home');
    }
}
