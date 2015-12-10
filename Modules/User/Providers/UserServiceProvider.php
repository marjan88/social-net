<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->make('Modules\User\Http\Controllers\UserController');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'user');

        $this->publishes([
            __DIR__ . '/../Views' => base_path('resources/views/vendor/user'),
        ]);
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

}
