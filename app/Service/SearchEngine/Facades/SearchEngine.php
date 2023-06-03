<?php

namespace App\Service\SearchEngine\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static mixed Search(mixed $builder)
 * @method static void Index(array $params)
 * @method static void  Delete(string $models)
 */
class SearchEngine extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'SearchEngin';
    }
}
