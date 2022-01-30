<?php

namespace App\Api\Shinservice1C\Order;

use App\Api\ApiResponse;
use App\Api\Shinservice1C\Order\Request\LoadOrderForDeliveryRequest;
use App\Api\Shinservice1C\Order\Response\LoadOrderForDeliveryResponse;
use App\Api\EntityResponse;
use App\Api\Shinservice1C\AbstractHandler;
use App\Api\Validator\InstanceValidator;
use App\Entity\OrderForDelivery;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class LoadOrderForDeliveryHandler extends AbstractHandler
{
    public function handle(LoadOrderForDeliveryRequest $request): Response
    {
        try {
            /** @var OrderForDelivery|null $orderForDelivery */
            $orderForDelivery = $this->entityManager->getRepository(OrderForDelivery::class)
                ->find($request->id);
            $this->instanceValidator->validateOrderForDelivery($request->id, $orderForDelivery);

            $loadOrderForDeliveryResponse = new LoadOrderForDeliveryResponse($orderForDelivery);

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