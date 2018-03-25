<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
      if (session()->has('adminuser') && \App\Http\Controllers\Controller::checkAdmin(session('adminuser'))) {
        return $next($request);
      }

      return redirect('admin')->with('error', 'Please login first!');

    }
}
