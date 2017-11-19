<?php
/**
 * Created by PhpStorm.
 * User: riggllm
 * Date: 2/17/17
 * Time: 10:09 PM
 */

use App\Models\User;
use App\Models\Recipe;
use App\Models\Direction;
use App\Models\Ingredient;

if ( !function_exists( 'user' ) ) {
    /**
     * @return User
     */
    function user()
    {
        return app( App\Models\User::class );
    }
}

if ( !function_exists( 'recipe' ) ) {
    /**
     * @return Recipe
     */
    function recipe()
    {
        return app( Recipe::class );
    }
}

if ( !function_exists( 'direction' ) ) {
    /**
     * @return Direction
     */
    function direction()
    {
        return app( App\Models\Direction::class );
    }
}

if ( !function_exists( 'ingredient' ) ) {
    /**
     * @return Ingredient
     */
    function ingredient()
    {
        return app( Ingredient::class );
    }
}
