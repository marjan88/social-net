<?php

namespace Modules\Page\Providers;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {       
       
        $this->app->make('Modules\Page\Http\Controllers\PageController');
        $this->loadViewsFrom(__DIR__.'/../Views', 'page');
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
