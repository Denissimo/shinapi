<?php

namespace App\Controller;

use App\Api\Shinservice1C\Order\LoadOrderForDeliveryHandler;
use App\Api\Shinservice1C\Order\Request\AddOrderForDeliveryRequest;
use App\Api\Shinservice1C\Order\AddOrderForDeliveryHandler;
use App\Api\Shinservice1C\Order\Request\LoadOrderForDeliveryRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Shinservice1CController extends AbstractController
{
    public function addOrderForDelivery(Request $request, AddOrderForDeliveryHandler $handler): Response
    {
        $addOrderForDeliveryRequest = new AddOrderForDeliveryRequest($request, $user);

        return $handler->handle($addOrderForDeliveryRequest);
    }

    public function loadOrderForDelivery(Request $request, LoadOrderForDeliveryHandler $handler): Response
    {
        /** @var SonataUserUser $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $loadOrderForDeliveryRequest = new LoadOrderForDeliveryRequest($request, $user);

        return $handler->handle($loadOrderForDeliveryRequest);
    }
    public function deleteOrderForDelivery(Request $request, DeleteOrderForDeliveryHandler $handler): Response
    {
        /** @var SonataUserUser $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $deleteOrderForDeliveryRequest = new DeleteOrderForDeliveryRequest($request, $user);

        return $handler->handle($deleteOrderForDeliveryRequest);
    }

    public function updateOrderForDelivery(Request $request, UpdateOrderForDeliveryHandler $handler): Response
    {
        /** @var SonataUserUser $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $updateOrderForDeliveryRequest = new UpdateOrderForDeliveryRequest($request, $user);

        return $handler->handle($updateOrderForDeliveryRequest);
    }
}