<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 8:02 PM
 */

if ( !function_exists( 'current_route' ) ) {
    /**
     * Get the current route
     *
     * @return null|string
     */
    function current_route()
    {
        return Route::currentRouteName();
    }
}
