<?php

namespace App\Controller;

use App\Service\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ShinserviceProxyController extends AbstractController
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->logger = new Logger('soap_log');
        $this->logger->pushHandler(
            new StreamHandler(
                __DIR__ . '/../../var/log/soap_log.log',
                Logger::DEBUG
            )
        );
    }

    public function uploadOrderForDelivery(Request $request): Response
    {
        return $this->sendRequest($request, 'UploadOrderForDelivery');
    }

    public function uploadSalesMark(Request $request): Response
    {
        return $this->sendRequest($request, 'UploadSalesMark');
    }

    public function downloadMarksToOrderForDelivery(Request $request): Response
    {
        return $this->sendRequest( $request,'DownloadMarksToOrderForDelivery');
    }

    public function downloadSalesMark(Request $request): Response
    {
        return $this->sendRequest( $request,'DownloadSalesMark');
    }


    public function soap(Request $request): Response
    {
        return $this->sendXmlRequest( $request );
    }

    private function sendRequest(Request $request, string $action): Response
    {
        $response1C = $this->client->sendProxyRequest(
            $action,
            $request->getContent() ?? null,
            $request->getMethod(),
            ['DocumentNumber' => $request->query->get('DocumentNumber')]
        );
        $response = new Response();
        $response->setContent($response1C->getContent());

        return $response;
    }

    private function sendXmlRequest(Request $request): Response
    {
        $response1C = $this->client->sendProxyXmlRequest(
            $request->getContent() ?? null,
            $request->getMethod()
        );

        $this->logger->debug('Run soap',
            [
                'content' => $request->getContent(),
                'response' => $response1C->getContent(),
            ]
        );

        $response = new Response();
        $response->setContent($response1C->getContent());

        return $response;
    }
}