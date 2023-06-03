<?php

namespace App\Service\SearchEngine;

use App\Service\SearchEngine\Facades\SearchEngine;

trait Searchable
{
    /**
     * @return string
     */
    public function getIndexName(): string
    {
        return $this->indexName;
    }

    /**
     * @return mixed
     */
    public function getIndexId(): mixed
    {
        return $this->getAttribute($this->indexId ?? $this->primaryKey);
    }


    /**
     * @return array
     */
    public function getModelParams(): array
    {
        return [
            'index' => $this->getIndexName(),
            'id'    => $this->getIndexId(),
            'body'  => $this->toSearchableArray(),
        ];
    }

    /**
     * @param $keyword
     * @return array
     */
    public function getModelQuery($keyword): array
    {
        return [
            'index' => $this->getIndexName(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        "query" => $keyword,
                        "fuzziness"=> "1"
                    ],
                ],
            ],
        ];
    }

    protected static function booting(): void
    {
        static::created(function ($model) {
            SearchEngine::Index($model->getModelParams());
        });
        static::updated(function ($model) {
            SearchEngine::Index($model->getModelParams());
        });
        static::deleted(function ($model) {
            SearchEngine::Delete($model->getModelParams());
        });
    }

    public static function FastSearch($keyword)
    {
        $instance = new static;
        return SearchEngine::Search($instance->getModelQuery($keyword));
    }
}
