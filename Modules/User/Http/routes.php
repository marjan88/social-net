<?php

// LOGIN
Route::get('/login', ['uses' => 'Auth\AuthController@getLogin', 'as' => 'login']);
Route::post('/login', ['uses' => 'Auth\AuthController@postLogin', 'as' => 'login']);
Route::get('/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'logout']);

// REGISTER
Route::get('/register', ['uses' => 'Auth\AuthController@getRegister', 'as' => 'register']);
Route::post('/register', ['uses' => 'Auth\AuthController@postRegister', 'as' => 'register']);

// SEARCH
Route::get('/search', ['uses' => 'SearchController@getResults', 'as' => 'search.results']);

// PROFILE
Route::get('/user/{username}', ['uses' => 'ProfileController@getProfile', 'as' => 'user.profile']);
Route::get('/profile/edit', ['uses' => 'ProfileController@getEdit', 'as' => 'user.profile.edit']);
Route::post('/profile/edit', ['uses' => 'ProfileController@postEdit', 'as' => 'user.profile.update']);

//FRIENDS
Route::get('/friends', ['uses' => 'FriendController@index', 'as' => 'user.friends']);