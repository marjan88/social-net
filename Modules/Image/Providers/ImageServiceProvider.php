<?php

namespace Modules\Image\Providers;

use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {       
       
        $this->app->make('Modules\Image\Http\Controllers\ImageController');
        $this->loadViewsFrom(__DIR__.'/../Views', 'image');
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
