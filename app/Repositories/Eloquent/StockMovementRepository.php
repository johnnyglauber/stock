<?php

namespace App\Repositories\Eloquent;

use App\Models\StockMovement;
use App\Repositories\StockMovementRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class StockMovementRepository
 *
 */
class StockMovementRepository extends BaseRepository implements StockMovementRepositoryInterface
{
    /**
     * StockMovementRepository constructor.
     *
     * @param StockMovement $model
     * @return void
     */
    public function __construct(StockMovement $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
