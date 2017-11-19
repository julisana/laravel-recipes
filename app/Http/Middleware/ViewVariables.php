<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class ViewVariables
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
        view()->share( 'currentRoute', current_route() );

        $messages = [
            'errors' => session()->pull( 'message.error', '' ),
            'success' => session()->pull( 'message.success', '' ),
            'warning' => session()->pull( 'message.warning', '' ),
        ];

        view()->share( 'messages', $messages );

        return $next($request);
    }
}
