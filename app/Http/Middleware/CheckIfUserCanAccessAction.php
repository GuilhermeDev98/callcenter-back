<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfUserCanAccessAction
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

        //$permission = $request->route()->action['as'];
        
        /*if(!auth()->user()->role->permissions->pluck('name')->contains($permission)){
            abort(401, 'Not Authorized');
        }*/

        return $next($request);
    }
}
