<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group( [ 'middleware' => [ 'force.ssl', 'global.variables' ] ], function () {
    Route::get( '/', [ 'as' => 'index', 'uses' => 'HomeController@index' ] );

    Route::group( [ 'prefix' => '/recipes' ], function () {
        //All Recipes
        Route::get( '/', [ 'as' => 'recipes.index', 'uses' => 'RecipeController@index' ] );

        //Specific Recipe
        Route::get( '{slug}/{id}', [ 'middleware' => [ 'check.slug' ], 'as' => 'recipes.show', 'uses' => 'RecipeController@show' ] )
            ->where( 'id', '[\d]+' );

        Route::get( '{id}/edit', [ 'as' => 'recipes.edit', 'uses' => 'RecipeController@edit' ] )
            ->where( 'id', '[\d]+' );
        Route::post( '{id}/edit', [ 'uses' => 'RecipeController@update' ] )
            ->where( 'id', '[\d]+' );

        Route::get( 'create', [ 'as' => 'recipes.create', 'uses' => 'RecipeController@create' ] );
        Route::post( 'create', [ 'uses' => 'RecipeController@store' ] );
    } );
} );
