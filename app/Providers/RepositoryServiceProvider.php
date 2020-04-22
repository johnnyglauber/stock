<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\DataSourceRepositoryInterface;
use App\Repositories\Eloquent\DataSourceRepository;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 *
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(DataSourceRepositoryInterface::class, DataSourceRepository::class);
    }
}
