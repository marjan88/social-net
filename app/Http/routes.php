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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
//Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
//Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
//
//Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
//
//Route::get('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
//Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);
//
//Route::get('/search', ['as' => 'search.results', 'uses' => 'SearchController@getResults']);
