<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 */
class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): ?Model
    {
        $model = $this->model->newInstance($attributes);
        $model->save();
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function find($id): ?Model
    {
        $query = $this->model->newQuery();
        return $query->find($id);
    }

    /**
     * @inheritDoc
     */
    public function update(array $attributes, $id): Model
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        $model->fill($attributes);
        $model->save();
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        return $model->delete();
    }
}
