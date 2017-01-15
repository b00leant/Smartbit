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
        //if(BrowserDetect::browserFamily() == 'Edge'){
        if(BrowserDetect::isIEVersion(9) or
        BrowserDetect::isIEVersion(8) or
        BrowserDetect::isIEVersion(7) or
        BrowserDetect::isIEVersion(6)){
            return redirect('/not-supported');
        }else{
            return $next($request);
        }
    }
}
