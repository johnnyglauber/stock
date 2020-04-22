<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception;

/**
 * Interface EloquentRepositoryInterface
 *
 */
interface EloquentRepositoryInterface
{
    /**
     * Create a new model
     *
     * @param array $attributes
     * @return Model|null
     */
    public function create(array $attributes): ?Model;

    /**
     * Find a model by Id
     *
     * @param integer $id
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * Update model record for given Id
     *
     * @param array $attributes
     * @param integer $id
     * @throws Exception
     * @return Model
     */
    public function update(array $attributes, $id): Model;

    /**
     * Delete model record from storage for a given Id
     *
     * @param integer $id
     * @throws Exception
     * @return bool|mixed|null
     */
    public function delete($id): bool;
}
