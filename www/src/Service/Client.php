<?php

namespace App\Service;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Exception;

class Client
{
    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $url;

    /**
     * Client constructor.
     *
     * @param HttpClientInterface $client
     * @param string $apiUrl
     */
    public function __construct(HttpClientInterface $client, string $apiUrl)
    {
        $this->client = $client;
        $this->url = $apiUrl;
    }


    public function sendJson(string $path, ?string $json, ?string $method, $query = [], $headers = [])
    {
        $fullPath = $this->url . $path;
        $options = $this->buildOptions($json, $query, $headers);

        $response = $this->client->request(
            $method ?? 'GET',
            $fullPath,
            $options
        );

        switch (true) {
            case $response->getStatusCode() == Response::HTTP_UNAUTHORIZED:
            throw new AccessDeniedException('Unauthorized access denied', $response->getStatusCode());
            break;

            case $response->getStatusCode() == Response::HTTP_NOT_FOUND:
            throw new BadRequestHttpException(
                'Data not found',
                null,
                $response->getStatusCode()
            );
            break;

            case $response->getStatusCode() != Response::HTTP_OK:
                throw new Exception(
                    'Unrecognized error',
                    $response->getStatusCode()
                );
            break;
        }

        return json_decode($response->getContent());
    }

    public function sendProxyRequest(string $path, ?string $json, ?string $method, $query = [], $headers = [])
    {
        $fullPath = $this->url . $path;
        $options = $this->buildOptions($json, $query, $headers);

        return $this->client->request(
            $method ?? 'GET',
            $fullPath,
            $options
        );
    }


    private function buildOptions(?string $json, $query = [], $headers = []) :array
    {
        $options = [];

        if (count((array)$headers)) {
            $options['headers'] = $headers;
        }

        if (count((array)$query)) {
            $options['query'] = $query;
        }

        if (isset($json)) {
            $options['json'] = json_decode($json);
        }

        return $options;
    }
}