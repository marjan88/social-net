<?php

namespace Modules\Album\Providers;

use Illuminate\Support\ServiceProvider;

class AlbumServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->make('Modules\Album\Http\Controllers\AlbumController');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'albums');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScientistRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineScientistRepository(
                    $app['em'], $app['em']->getClassMetaData(Scientist::class)
            );
        });
    }

}
