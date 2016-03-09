<?php

namespace MqCMS\Providers;

use MqCMS\View\ThemeViewFinder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->setFinder($this->app['theme.finder']);
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('theme.finder', function($app){
            $finder = new ThemeViewFinder($app['files'], $app['config']['view.paths']);
            
            $config = $app['config']['cms.theme'];
            
            $finder->setBasePath($app['path.public']. '/' . $config['folder']);
            $finder->setActiveTheme($config['active']);
            
            return $finder;
            
        });
//        $this->app->bind(
//                'Illuminate\Contracts\Auth\Registrar', 'MqCMS\Services\Registrar'
//        );
//        if ($this->app->environment() == 'local') {
//            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
//        }
    }

}
