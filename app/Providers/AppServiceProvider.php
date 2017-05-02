<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\User;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\DoctrineUserRepository;
use App\Entities\Dream;
use App\Repositories\DreamRepositoryInterface;
use App\Repositories\DoctrineDreamRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->bind(UserRepositoryInterface::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineUserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
            );
        });

        $this->app->bind(DreamRepositoryInterface::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineDreamRepository(
                $app['em'],
                $app['em']->getClassMetaData(Dream::class)
            );
        });
    }
}
