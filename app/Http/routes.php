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

Route::group(['prefix' => 'recipes'], function() {
    Route::get('/', ['as' => 'recipes.index', 'uses' => 'RecipeController@index']);
    Route::get('{recipeSlug}/{id}', ['as' => 'recipes.show', 'uses' => 'RecipeController@show'])
        ->where('id', '[\d]+');
});

Route::group(['prefix' => 'profile'], function() {
//Route::group(['prefix' => 'profile', 'middleware' => ['https', 'auth']], function() {
    Route::get('/', ['as' => 'profile.index', 'uses' => 'ProfileController@index']);
    Route::get('/recipes', ['as' => 'profile.recipes', 'uses' => 'ProfileController@recipes']);
    Route::get('/{recipeSlug}/{id}', ['as' => 'profile.recipes.show', 'uses' => 'ProfileController@recipe'])
        ->where('id', '[\d]+');
});
