<?php


Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('/search', ['as' => 'search.results', 'uses' => 'SearchController@getResults']);
