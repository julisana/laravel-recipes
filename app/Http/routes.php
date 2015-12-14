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

Route::group(['prefix' => 'auth'], function() {
    Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

    // Registration routes...
    Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
    Route::post('register', ['as' => 'auth.create', 'uses' => 'Auth\AuthController@postRegister']);
});

/*Route::group(['prefix' => 'password'], function() {
    Route::get('/email', []);
    Route::get('/reset', []);
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);*/

Route::group(['prefix' => 'recipes'], function() {
    Route::get('/', ['as' => 'recipes.index', 'uses' => 'RecipeController@index']);
    Route::get('{recipeSlug}/{id}', ['as' => 'recipes.show', 'uses' => 'RecipeController@show'])
        ->where('id', '[\d]+');
});

Route::group(['prefix' => 'profile', 'middleware' => [/*'https', */'auth']], function() {
    Route::get('/', ['as' => 'profile.index', 'uses' => 'ProfileController@index']);

    //Users can edit their profile
    Route::get('/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::patch('/edit', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

    Route::group(['prefix' => 'recipes'], function() {
        Route::get('/', ['as' => 'profile.recipes.index', 'uses' => 'ProfileController@recipes']);
        //Route::get('/{id}', ['as' => 'profile.recipes.show', 'uses' => 'ProfileController@recipe'])
        //    ->where('id', '[\d]+');

        //Edit a recipe that was created by the user.
        Route::get('/{id}/edit', ['as' => 'profile.recipes.edit', 'uses' => 'RecipeController@edit'])
            ->where('id', '[\d]+');
        Route::post('/{id}/edit', ['as' => 'profile.recipes.update', 'uses' => 'RecipeController@update'])
            ->where('id', '[\d]+');

        //Create a new recipe
        Route::get('/new', ['as' => 'profile.recipes.create', 'uses' => 'RecipeController@create']);
        Route::post('/new', ['as' => 'profile.recipes.store', 'uses' => 'RecipeController@store']);
    });
});
