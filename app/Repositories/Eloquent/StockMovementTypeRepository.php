<?php

namespace App\Repositories\Eloquent;

use App\Models\StockMovementType;
use App\Repositories\StockMovementTypeRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class StockMovementTypeRepository
 *
 */
class StockMovementTypeRepository extends BaseRepository implements StockMovementTypeRepositoryInterface
{
    /**
     * StockMovementTypeRepository constructor.
     *
     * @param StockMovementType $model
     * @return void
     */
    public function __construct(StockMovementType $model)
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
