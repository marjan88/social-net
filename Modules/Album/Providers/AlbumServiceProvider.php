<?php

namespace Modules\Album\Providers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Modules\Album\Model\DoctrineORM\Entity\Album;
use Modules\Album\Model\DoctrineORM\AlbumRepositoryInterface;
use Modules\Album\Model\DoctrineORM\Repository\AlbumRepository;

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
        $this->loadViewsFrom(__DIR__ . '/../Views', 'album');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind(AlbumRepositoryInterface::class, function($app) {
//            // This is what Doctrine's EntityRepository needs in its constructor.            
//            return new AlbumRepository(
//                    $app['em'], $app['em']->getClassMetaData(Album::class)
//            );
//        });
    }

}
