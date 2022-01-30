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
            $head = null;
            if (isset($request->headId)) {
                /** @var Individual $head */
                $head = $this->entityManager->getRepository(Individual::class)
                    ->find($request->headId);
                $this->instanceValidator->validateIndividual($request->headId, $head);
            }

            $orderForDeliveryRequest = $request->orderForDelivery;
            $orderForDelivery = (new SalesMarkEntity())
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
            //$request->user->addRole(User::ROLE_SalesMark_HEAD);
            $this->entityManager->flush();

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