<?php

namespace App\Service\SearchEngine\Engines;

use App\Service\SearchEngine\Engine;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Client;
use Exception;

class Elastic extends Engine
{
    protected Client $ElasticSearch;

    /**
     * @throws AuthenticationException
     */
    public function __construct()
    {
        $config = json_decode(json_encode(config('search_engine.driver.elastic')));
        $this->ElasticSearch = ClientBuilder::create()->setHosts($config->hosts)->setBasicAuthentication($config->basicAuthentication->username, $config->basicAuthentication->password)->build();
    }

    /**
     * Perform the given search on the engine.
     *
     * @param mixed $params
     *
     * @return array
     * @throws ClientResponseException
     */
    public function Search(mixed $params): array
    {
        try {
            return $this->ElasticSearch->search($params)->asArray();
        }catch (Exception $e){
            return throw new ClientResponseException($e->getMessage());
        }
    }


    /**
     * @param array $params
     * @return array
     * @throws ClientResponseException
     */
    public function Index(array $params): array
    {
        try {
            return $this->ElasticSearch->index($params)->asArray();
        }catch (Exception $e){
            return throw new ClientResponseException($e->getMessage());
        }

    }


    /**
     * @param array $params
     * @return array
     * @throws ClientResponseException
     */
    public function Delete(array $params): array
    {
        try {
            return $this->ElasticSearch->delete($params)->asArray();
        }catch (Exception $e){
            return throw new ClientResponseException($e->getMessage());
        }
    }

}
