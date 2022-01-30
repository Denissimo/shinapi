<?php

namespace App\Api\Shinservice1C\Order\Request;

use App\Api\Shinservice1C\Order\DTO\OrderForDeliveryData;
use App\Api\Shinservice1C\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddOrderForDeliveryRequest implements RequestHandlerInterface
{
    /**
     * @var array
     */
    public $data;

    /**
     * AddOrderForDeliveryRequest constructor.
     */
    public function __construct(Request $request)
    {
        $decodedRequest = json_decode($request->getContent(), true);

        $this->data = $decodedRequest['data'] ?? null;
    }
}