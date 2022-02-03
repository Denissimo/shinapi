<?php

namespace App\Api\Shinservice1C\Sale;

use App\Api\ApiResponse;
use App\Api\Shinservice1C\Sale\Response\AddSalesMarkResponse;
use App\Api\Shinservice1C\Sale\Request\AddSalesMarkRequest;
use App\Api\EntityResponse;
use App\Api\Shinservice1C\AbstractHandler;
use App\Api\Validator\InstanceValidator;
use App\Entity\SalesMark;
use App\Entity\SalesMark as SalesMarkEntity;
use App\Entity\Individual;
use App\Entity\UserDocument;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\SonataUserUser as User;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AddSalesMarkHandler extends AbstractHandler
{
    public function handle(AddSalesMarkRequest $request): Response
    {
        try {
            $orderForDeliveryResponse = new AddSalesMarkResponse($orderForDelivery);

            $response = new EntityResponse(
                $orderForDeliveryResponse,
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