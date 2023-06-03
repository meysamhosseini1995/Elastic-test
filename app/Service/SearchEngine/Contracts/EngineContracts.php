<?php

namespace App\Service\SearchEngine\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EngineContracts
{

    /**
     * Perform the given search on the engine.
     *
     * @param array $params
     * @return array
     */
    public function Search(array $params): array;


    /**
     * Update the given model in the index.
     *
     * @param array $params
     * @return array
     */
    public function Index(array $params): array;


    /**
     * Update the given model in the index.
     *
     * @param array $params
     * @return array
     */
    public function Delete(array $params): array;

}
