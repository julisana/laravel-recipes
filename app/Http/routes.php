<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['https', 'auth']], function () {

});

Route::group(['prefix' => 'recipes'], function() {
    Route::get('/', ['as' => 'recipes.index', 'uses' => 'RecipeController@index']);
    Route::get('{recipeSlug}/{id}', [ 'as' => 'recipes.show', 'uses' => 'RecipeController@show' ])
        ->where('id', '[\d]+');
});