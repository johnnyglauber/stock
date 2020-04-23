<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface ProductRepositoryInterface
 *
 */
interface ProductRepositoryInterface
{
    /**
     * Return a collection of the model
     *
     * @return Collection
     */
    public function all(): Collection;
}
