<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;
use Auth;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::has('MasterUser*%') && Auth::guard('master_users')->user() && Auth::guard('master_users')->user()->status == 'active'){     
            return $next($request);
        }
        Auth::guard('master_users')->logout();
        Session::forget('MasterUser*%');
        return redirect('/');
    }
}
