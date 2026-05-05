<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 2/17/17
 * Time: 10:09 PM
 */

use App\Models\File;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Direction;
use App\Models\Ingredient;
use App\Models\PantryItem;
use App\Models\SpiceRackItem;

if ( !function_exists( 'file' ) ) {
    /**
     * @return File
     */
    function file()
    {
        return app( File::class );
    }
}

if ( !function_exists( 'user' ) ) {
    /**
     * @return User
     */
    function user()
    {
        return app( User::class );
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
        return app( Direction::class );
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

if ( !function_exists( 'pantryItem' ) ) {
    /**
     * @return PantryItem
     */
    function pantryItem()
    {
        return app( PantryItem::class );
    }
}

if ( !function_exists( 'spiceRackItem' ) ) {
    /**
     * @return SpiceRackItem
     */
    function spiceRackItem()
    {
        return app( SpiceRackItem::class );
    }
}
