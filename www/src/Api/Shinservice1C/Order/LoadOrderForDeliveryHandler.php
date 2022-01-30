<?php

namespace App\Api\Shinservice1C\Order;

use App\Api\ApiResponse;
use App\Api\Shinservice1C\Order\Request\LoadOrderForDeliveryRequest;
use App\Api\Shinservice1C\Order\Response\LoadOrderForDeliveryResponse;
use App\Api\Shinservice1C\AbstractHandler;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use App\Api\EntityResponse;

class LoadOrderForDeliveryHandler extends AbstractHandler
{
    public function handle(LoadOrderForDeliveryRequest $request): Response
    {
        try {
            $ordersForDelivery = (array)$this->client->sendJson(
                'UploadOrderForDelivery',
                null,
                null,
                ['DocumentNumber' => $request->id]
            );

//            $current = current($ordersForDelivery);
//            var_dump($current->Марка);
//            die;
            $loadOrderForDeliveryResponse = array_map(
                function ($orderForDelivery) {
                    return new LoadOrderForDeliveryResponse($orderForDelivery);
                },
                $ordersForDelivery
            );


            $response = new EntityResponse(
                $loadOrderForDeliveryResponse,
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