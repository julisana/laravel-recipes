<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 2/17/17
 * Time: 10:09 PM
 */

use Spatie\Tags\Tag;
use App\Models\File;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Direction;
use App\Models\Ingredient;

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

if ( !function_exists( 'tag' ) ) {
    /**
     * @return Tag
     */
    function tag()
    {
        return app( Tag::class );
    }
}
