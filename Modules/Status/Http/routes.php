<?php

Route::post('status', ['uses' => 'StatusController@postStatus', 'as' => 'add.status']);
Route::post('status/{statusId}/reply', ['uses' => 'StatusController@postReply', 'as' => 'reply.status']);
Route::post('status/delete', ['uses' => 'StatusController@deleteStatus', 'as' => 'delete.status']);

// LIKES
Route::get('status/{statusId}/like', ['uses' => 'StatusController@getLike', 'as' => 'like.status']);
Route::get('status/{statusId}/unlike', ['uses' => 'StatusController@deleteLike', 'as' => 'unlike.status']);

// API
Route::group(['prefix' => 'api'], function () {
   Route::get('statuses', ['uses' => 'StatusController@getAllStatuses']);
   Route::post('statuses', ['uses' => 'StatusController@postStatus']);
});
