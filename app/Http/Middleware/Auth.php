<?php

namespace App\Http\Controllers;

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\View;
use App\Model;

class Auth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

    	if ($request->session()->has('SESS_userid') && $request->session()->has('user_type') == '1') {
    		return $next($request);
        }else{
        	$request->session()->pull('SESS_userid');
        	$request->session()->pull('user_type');
           return redirect('/');

        }
    }
}
