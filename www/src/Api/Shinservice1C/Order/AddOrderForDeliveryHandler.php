<?php

namespace App\Api\Shinservice1C\Order;

use App\Api\ApiResponse;
use App\Api\Shinservice1C\Order\Response\AddOrderForDeliveryResponse;
use App\Api\Shinservice1C\Order\Request\AddOrderForDeliveryRequest;
use App\Api\EntityResponse;
use App\Api\Shinservice1C\AbstractHandler;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\SonataUserUser as User;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AddOrderForDeliveryHandler extends AbstractHandler
{
    public function handle(AddOrderForDeliveryRequest $request): Response
    {
        try {
            $head = null;
            if (isset($request->headId)) {
                /** @var Individual $head */
                $head = $this->entityManager->getRepository(Individual::class)
                    ->find($request->headId);
                $this->instanceValidator->validateIndividual($request->headId, $head);
            }

            $orderForDeliveryRequest = $request->orderForDelivery;
            $orderForDelivery = (new OrderForDeliveryEntity())
                ->setUser($request->user)
                ->setHead($head)
                ->setPhone($orderForDeliveryRequest->phone)
                ->setEmail($orderForDeliveryRequest->email)
                ->setOgrn($orderForDeliveryRequest->ogrn)
                ->setInn($orderForDeliveryRequest->inn)
                ->setActive($orderForDeliveryRequest->active)
            ;

            foreach ($request->representative as $representativeId) {
                $representative = $this->loadIndividual($representativeId);
                $orderForDelivery->addRepresentative($representative);
            }

            $this->entityManager->persist($orderForDelivery);
            //$request->user->addRole(User::ROLE_OrderForDelivery_HEAD);
            $this->entityManager->flush();

            $orderForDeliveryResponse = new AddOrderForDeliveryResponse($orderForDelivery);

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