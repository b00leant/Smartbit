<?php

namespace App\Http\Middleware;

use Closure;
use BrowserDetect;

class BDetect
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
        if(BrowserDetect::browserFamily() == 'Edge'){
        //if(BrowserDetect::isIEVersion(10, true)){
            return redirect('/not-supported');
        }else{
            return $next($request);
        }
    }
}
