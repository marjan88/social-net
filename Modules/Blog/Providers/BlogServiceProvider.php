<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {       
       
        $this->app->make('Modules\Blog\Http\Controllers\BlogController');
        $this->loadViewsFrom(__DIR__.'/../Views', 'blog');
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
