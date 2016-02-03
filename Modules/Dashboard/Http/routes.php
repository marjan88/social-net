<?php

// API
Route::group(['middleware' => 'admin'], function () {
    Route::resource('dashboard', 'DashboardController');
});

