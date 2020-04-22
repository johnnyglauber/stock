<?php

namespace App\Repositories\Eloquent;

use App\Models\DataSource;
use App\Repositories\DataSourceRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class DataSourceRepository
 *
 */
class DataSourceRepository extends BaseRepository implements DataSourceRepositoryInterface
{
    /**
     * DataSourceRepository constructor.
     *
     * @param DataSource $model
     * @return void
     */
    public function __construct(DataSource $model)
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
