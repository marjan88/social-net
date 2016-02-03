<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $middleware = [
        'Dashboard' => [
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

        $this->app->make('Modules\Dashboard\Http\Controllers\DashboardController');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'admin');
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
