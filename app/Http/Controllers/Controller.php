<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array
     */
    protected $context = [];

    /**
     * If we need to add an error message (or any other kind of message), pull the existing messages
     * and add to it.
     *
     * @param string $type
     * @param mixed $value
     *
     * @return Controller
     */
    protected function addMessage( $type, $value )
    {
        $messages = view()->shared( 'messages', [] );
        if ( empty( $messages ) ) {
            $messages = array_get( $this->context, 'messages', [] );
        }

        //Errors is the only 'message' that's got a plural name, let's check for the singular just in case.
        if ( $type == 'error' ) {
            $type = 'errors';
        }

        if ( !is_array( $messages[ $type ] ) ) {
            $newMessages = [];
        }
        if ( !empty( $messages[ $type ] ) ) {
            $newMessages[] = [ $messages[ $type ] ];
        }

        $newMessages[] = $value;
        $messages[ $type ] = $newMessages;

        return $this->addContext( 'messages', $messages );
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return $this
     */
    protected function addContext( $key, $value )
    {
        array_set( $this->context, $key, $value );

        return $this;
    }
}
