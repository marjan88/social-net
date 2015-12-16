<?php

Route::get('albums', ['uses' => 'ImageAlbumController@index', 'as' => 'albums']);
