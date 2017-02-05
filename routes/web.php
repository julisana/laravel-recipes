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

Route::get( '/', 'HomeController@index' );

//Route::group( [ 'prefix' => 'auth' ], function() {
//    Route::get( 'login', [ 'as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin' ] );
//    Route::post( 'login', 'Auth\AuthController@postLogin' );
//    Route::get( 'logout', [ 'as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout' ] );
//    // Registration routes...
//    Route::get( 'register', [ 'as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister' ] );
//    Route::post( 'register', [ 'as' => 'auth.create', 'uses' => 'Auth\AuthController@postRegister' ] );
//} );

Route::group( [ 'prefix' => 'recipes' ], function() {
    //All Recipes
    Route::get( '/', [ 'as' => 'recipes.index', 'uses' => 'RecipeController@index' ] );
    //Specific Recipe
    Route::get( '{recipeSlug}/{id}', [ 'as' => 'recipes.show', 'uses' => 'RecipeController@show' ] )
        ->where( 'id', '[ \d ]+' );
} );
Route::group( [ 'prefix' => 'profile', 'middleware' => [ /*'https', */'auth' ] ], function() {
    //Profile Index (My Profile)
    Route::get( '/', [ 'as' => 'profile.index', 'uses' => 'ProfileController@index' ] );
    //Edit profile (My Profile)
    Route::get( '/edit', [ 'as' => 'profile.edit', 'uses' => 'ProfileController@edit' ] );
    Route::patch( '/edit', [ 'as' => 'profile.update', 'uses' => 'ProfileController@update' ] );
    //My Recipes (Saved and My Creation)
    Route::group( [ 'prefix' => 'recipes' ], function() {
        Route::get( '/', [ 'as' => 'profile.recipes.index', 'uses' => 'ProfileController@recipes' ] );
        //Route::get( '/{id}', [ 'as' => 'profile.recipes.show', 'uses' => 'ProfileController@recipe' ] )
        //    ->where( 'id', '[ \d ]+' );
        //Edit Recipe (My Creation)
        Route::get( '/{id}/edit', [ 'as' => 'profile.recipes.edit', 'uses' => 'RecipeController@edit' ] )
            ->where( 'id', '[ \d ]+' );
        Route::patch( '/{id}/edit', [ 'as' => 'profile.recipes.update', 'uses' => 'RecipeController@update' ] )
            ->where( 'id', '[ \d ]+' );
        //New Recipe (My Creation)
        Route::get( '/new', [ 'as' => 'profile.recipes.create', 'uses' => 'RecipeController@create' ] );
        Route::post( '/new', [ 'as' => 'profile.recipes.store', 'uses' => 'RecipeController@store' ] );
        //Route::get( '/new/preview', [ 'as' => 'profile.recipes.preview', 'uses' => 'RecipeController@preview' ] );
    } );
} );