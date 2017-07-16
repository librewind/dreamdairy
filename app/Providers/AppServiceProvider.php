<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\User;
use App\Repositories\UserRepository;
use App\Entities\Dream;
use App\Repositories\DreamRepository;

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

        $this->app->bind(UserRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new UserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
            );
        });

        $this->app->bind(DreamRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DreamRepository(
                $app['em'],
                $app['em']->getClassMetaData(Dream::class)
            );
        });
    }
}
