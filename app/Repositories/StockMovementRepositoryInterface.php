<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface StockMovementRepositoryInterface
 *
 */
interface StockMovementRepositoryInterface
{
    /**
     * Return a collection of the model
     *
     * @return Collection
     */
    public function all(): Collection;
}
