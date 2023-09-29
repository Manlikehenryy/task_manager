<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
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
        if ($request->user()->email=="hilary@gmail.com") {
            return $next($request);
        }
        else{
            return  response()->json(["status"=>"failed"], 401);;
        }
        
    }
}
