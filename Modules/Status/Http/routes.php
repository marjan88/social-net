<?php

Route::post('status', ['uses' => 'StatusController@postStatus', 'as' => 'add.status']);
Route::post('status/{statusId}/reply', ['uses' => 'StatusController@postReply', 'as' => 'reply.status']);
