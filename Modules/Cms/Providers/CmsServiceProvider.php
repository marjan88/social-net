<?php

namespace Modules\Cms\Providers;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $middleware = [
        'Cms' => [
            'admin' => 'Admin',
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware($this->app['router']);

        $this->app->make('Modules\Cms\Http\Controllers\CmsController');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'cms');
         $this->publishes([
            __DIR__ . '/../public' => base_path('public/assets/'),          
        ]);
        $this->publishes([
            __DIR__ . '/../Views' => base_path('resources/views/vendor'),          
        ]);
        
       
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       
       
    }

    private function registerMiddleware($router)
    {
        foreach ($this->middleware as $module => $middlewares) {
            foreach ($middlewares as $name => $middleware) {
                $class = "Modules\\{$module}\\Http\\Middleware\\{$middleware}";

                $router->middleware($name, $class);
            }
        }
    }

}
