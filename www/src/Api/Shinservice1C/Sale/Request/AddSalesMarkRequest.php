<?php

namespace App\Api\Shinservice1C\Sale\Request;

use App\Api\Shinservice1C\Sale\DTO\SalesMarkData;
use App\Api\Shinservice1C\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddSalesMarkRequest implements RequestHandlerInterface
{
    /**
     * @var array
     */
    public $data;

    /**
     * AddSalesMarkRequest constructor.
     */
    public function __construct(Request $request)
    {
        $decodedRequest = json_decode($request->getContent(), true);

        $this->data = $decodedRequest['data'] ?? null;
    }
}