<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $middleware = [
        'User' => [
            'cors' => 'Cors',
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

        $this->app->make('Modules\User\Http\Controllers\UserController');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'user');

        $this->publishes([
            __DIR__ . '/../Views'                       => base_path('resources/views/vendor/user'),
            __DIR__ . '/../Lang'                        => base_path('resources/lang'),
            __DIR__ . '/../database/migrations'         => base_path('database/migrations'),
            __DIR__ . '/../config/module.user.auth.php' => config_path('module.user.auth.php'),
        ]);
        $this->app['config']['auth'] = \Config::get('module.user.auth');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                'Illuminate\Contracts\Auth\Registrar', 'Modules\User\Services\Registrar'
        );
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
