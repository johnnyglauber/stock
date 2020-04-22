<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface StockMovementTypeRepositoryInterface
 *
 */
interface StockMovementTypeRepositoryInterface
{
    /**
     * Return a collection of the model
     *
     * @return Collection
     */
    public function all(): Collection;
}
