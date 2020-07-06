<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

