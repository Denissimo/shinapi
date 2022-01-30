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
        $addOrderForDeliveryRequest = new AddOrderForDeliveryRequest($request);


        return $handler->handle($addOrderForDeliveryRequest);
    }

    public function loadOrderForDelivery(Request $request, LoadOrderForDeliveryHandler $handler): Response
    {
        $loadOrderForDeliveryRequest = new LoadOrderForDeliveryRequest($request);

        return $handler->handle($loadOrderForDeliveryRequest);
    }

    public function addSalesMark(Request $request, AddOrderForDeliveryHandler $handler): Response
    {
        $addOrderForDeliveryRequest = new AddOrderForDeliveryRequest($request);


        return $handler->handle($addOrderForDeliveryRequest);
    }

    public function loadSalesMark(Request $request, LoadOrderForDeliveryHandler $handler): Response
    {
        $loadOrderForDeliveryRequest = new LoadOrderForDeliveryRequest($request);

        return $handler->handle($loadOrderForDeliveryRequest);
    }
}