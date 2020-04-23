<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\DataSourceRepositoryInterface;
use App\Repositories\Eloquent\DataSourceRepository;
use App\Repositories\StockMovementTypeRepositoryInterface;
use App\Repositories\Eloquent\StockMovementTypeRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\StockMovementRepositoryInterface;
use App\Repositories\Eloquent\StockMovementRepository;
use App\Repositories\Eloquent\ProductRepository;
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
        $this->app->bind(StockMovementTypeRepositoryInterface::class, StockMovementTypeRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(StockMovementRepositoryInterface::class, StockMovementRepository::class);
    }
}
