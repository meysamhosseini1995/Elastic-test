<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Contract\EloquentRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


abstract class Repository implements EloquentRepositoryContract
{
    const perPage = 10;

    /**
     * @var Model
     */
    protected Model $model;

    protected array $selectableList = [];


    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($this->getColumns($columns));
    }

    /**
     * Paginate the given query.
     *
     * @param int|null $perPage
     * @param array $columns
     * @param array $relations
     * @param string $pageName
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function paginate(int|null $perPage = self::perPage, array $columns = ['*'], array $relations = [], string $pageName = 'page', int $page = null) : LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate($perPage,$this->getColumns($columns),$pageName,$page);
    }



    /**
     * Find model by id.
     *
     * @param int $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model|null
     */
    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }



    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    /**
     * Update existing model.
     *
     * @param int $modelId
     * @param array $payload
     * @return Model|null
     */
    public function update(int $modelId, array $payload): ?Model
    {
        $model = $this->findById($modelId);
        $model->update($payload);
        return $model->fresh();
    }

    /**
     * Delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }


    /**
     * get Columns
     *
     * @param array $columns
     * @return array
     */
    public function getColumns(array $columns): array
    {
        return (!empty($this->selectableList[0]) && $columns[0] == '*') ? $this->selectableList : $columns;
    }


}
