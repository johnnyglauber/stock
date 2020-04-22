<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface DataSourceRepositoryInterface
 *
 */
interface DataSourceRepositoryInterface
{
    /**
     * Return a collection of the model
     *
     * @return Collection
     */
    public function all(): Collection;
}
