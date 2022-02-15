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
    protected $apiUrl;

    /**
     * @var string
     */
    protected $soapUrl;

    /**
     * Client constructor.
     *
     * @param HttpClientInterface $client
     * @param string $apiUrl
     * @param string $soapUrl
     */
    public function __construct(HttpClientInterface $client, string $apiUrl, string $soapUrl)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
        $this->soapUrl = $soapUrl;
    }

    public function sendJson(string $path, ?string $json, ?string $method, $query = [], $headers = [])
    {
        $fullPath = $this->apiUrl . $path;
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
        $fullPath = $this->apiUrl . $path;
        $options = $this->buildOptions($json, $query, $headers);

        return $this->client->request(
            $method ?? 'GET',
            $fullPath,
            $options
        );
    }

    public function sendProxyXmlRequest(string $xml, ?string $method, $query = [], $headers = [])
    {
        $fullPath = $this->soapUrl;
        $options = $this->buildXmlOptions($xml, $query, $headers);

        return $this->client->request(
            $method ?? 'POST',
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

    private function buildXmlOptions(string $xml, $query = [], $headers = []) :array
    {
        $options = [];

        if (count((array)$headers)) {
            $options['headers'] = $headers;
        }

        if (count((array)$query)) {
            $options['query'] = $query;
        }

        $options['body'] = $xml;

        return $options;
    }
}