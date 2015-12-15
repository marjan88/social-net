<?php

Route::post('store-image', ['uses' => 'ImageController@storeImage', 'as' => 'store.image']);
