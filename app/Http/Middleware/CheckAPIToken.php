<?php

namespace App\Http\Middleware;

use Closure;

class CheckAPIToken
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
        $path = explode('/', $request->path());
        $prefix = env('DB_VIEW_PREFIX', '');
        $query = 'SELECT * FROM '.$prefix.'enduser WHERE api_token=?';
        $user = DB::select($query, [$path[1]]);

        if (count($user) == 1) {
          return $next($request);
        }
        return redirect('/api/error/invalid_token');
    }
}
