<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        date_default_timezone_set( 'America/Chicago' );

        \View::share( 'current_user', \Auth::user() );
        \View::share( 'current_route', \Route::currentRouteName() );

        $messages[ 'error' ] = \Session::get( 'message_error' );
        $messages[ 'success' ] = \Session::get( 'message_success' );
        $messages[ 'warning' ] = \Session::get( 'message_warning' );
        \View::share( 'messages', $messages );
    }
}
