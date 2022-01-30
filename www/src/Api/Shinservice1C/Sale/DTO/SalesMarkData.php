<?php

namespace App\Api\Shinservice1C\Sale\DTO;

use App\Api\Shinservice1C\BaseRequest;

class SalesMarkData extends BaseRequest
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
     * SalesMarkData constructor.
     *
     * @param array $orderForDelivery
     */
    public function __construct(array $orderForDelivery)
    {
        $this->mark = $orderForDelivery['mark'] ?? false;
        $this->nomenclature = $orderForDelivery['nomenclature'] ?? null;
    }
}