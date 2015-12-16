<?php

namespace Modules\ImageAlbum\Providers;

use Illuminate\Support\ServiceProvider;

class ImageAlbumServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {       
       
        $this->app->make('Modules\ImageAlbum\Http\Controllers\ImageAlbumController');
        $this->loadViewsFrom(__DIR__.'/../Views', 'image_album');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
