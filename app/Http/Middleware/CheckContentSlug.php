<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Recipe;

class CheckContentSlug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        if ( $request->route( 'id' ) && is_numeric( $request->route( 'id' ) ) ) {
            $recipe = Recipe::findOrFail( $request->route( 'id' ) );

            if ( is_object( $recipe ) && !empty( $recipe->getUrl() ) ) {
                if ( $recipe->getSlug() !== $request->route( 'slug', '' ) ) {
                    return redirect()->to( $recipe->getUrl(), 301 );
                }
            }
        }

        return $next( $request );
    }
}
