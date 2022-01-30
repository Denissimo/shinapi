<?php

namespace App\Api\Shinservice1C;

use App\Service\Client;

abstract class AbstractHandler
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @param Client $client
     * @param string $apiUrl
     */
    public function __construct(Client $client, string $apiUrl)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }
}