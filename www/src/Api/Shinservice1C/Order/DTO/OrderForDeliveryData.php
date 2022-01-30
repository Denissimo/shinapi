<?php

namespace App\Api\Shinservice1C\Order\DTO;

use App\Api\Shinservice1C\BaseRequest;

class OrderForDeliveryData extends BaseRequest
{
    /**
     * @var string
     */
    public $mark;

    /**
     * @var string
     */
    public $nomenclature;

    /**
     * OrderForDeliveryData constructor.
     *
     * @param array $orderForDelivery
     */
    public function __construct(array $orderForDelivery)
    {
        $this->mark = $orderForDelivery['mark'] ?? false;
        $this->nomenclature = $orderForDelivery['nomenclature'] ?? null;
    }
}