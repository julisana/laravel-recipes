<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckHttps.
 * @package App\Http\Middleware
 */
class CheckHttps
{
    /**
     * Handle an incoming request.
     * Checks to see if the current path is using https. If not,
     * the user is redirected to the https version of the path.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        if ( !$request->secure() ) {
            return redirect()->secure( $request->path() );
        }

        return $next( $request );
    }
}
