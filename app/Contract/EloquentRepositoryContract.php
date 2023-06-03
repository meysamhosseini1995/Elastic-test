<?php

namespace App\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EloquentRepositoryContract
{

    /**
     * Get all models.
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;


    /**
     * Paginate the given query.
     *
     * @param int|null $perPage
     * @param array $columns
     * @param array $relations
     * @param string $pageName
     * @param int|null $page
     * @return LengthAwarePaginator
     *
     */
    public function paginate(int $perPage = null, array $columns = ['*'], array $relations = [], string $pageName = 'page', int $page = null): LengthAwarePaginator;




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
    ): ?Model;



    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model;

    /**
     * Update existing model.
     *
     * @param int $modelId
     * @param array $payload
     * @return Model|null
     */
    public function update(int $modelId, array $payload): ?Model;

    /**
     * Delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;


    /**
     * get Columns
     *
     * @param array $columns
     * @return array
     */
    public function getColumns(array $columns): array;
}
