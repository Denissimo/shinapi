<?php

namespace App\Api\Shinservice1C\Sale;

use App\Api\ApiResponse;
use App\Api\Shinservice1C\Sale\Request\LoadSalesMarkRequest;
use App\Api\Shinservice1C\Sale\Response\LoadSalesMarkResponse;
use App\Api\Shinservice1C\AbstractHandler;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use App\Api\EntityResponse;

class LoadSalesMarkHandler extends AbstractHandler
{
    public function handle(LoadSalesMarkRequest $request): Response
    {
        try {
            $ordersForDelivery = (array)$this->client->sendJson(
                'UploadSalesMark',
                null,
                null,
                ['DocumentNumber' => $request->id]
            );

//            $current = current($ordersForDelivery);
//            var_dump($current->Марка);
//            die;
            $loadSalesMarkResponse = array_map(
                function ($orderForDelivery) {
                    return new LoadSalesMarkResponse($orderForDelivery);
                },
                $ordersForDelivery
            );


            $response = new EntityResponse(
                $loadSalesMarkResponse,
                null,
                ['Access-Control-Allow-Origin' => '*'],
                false
            );
        } catch (Exception $exception) {
            $response = new ApiResponse(
                [
                    'message' => $exception->getMessage()
                ],
                $exception->getCode()
            );
        }

        return $response;
    }
}