<?php

namespace App\Api\Shinservice1C\Order\DTO;

use App\Api\Shinservice1C\BaseRequest;

class Goods extends BaseRequest
{
    /**
     * @var integer
     */
    public $Количество;

    /**
     * @var string
     */
    public $Номенклатура;

    /**
     * OrderForDeliveryData constructor.
     *
     * @param array $orderForDelivery
     */
    public function __construct(array $orderForDelivery)
    {
        $this->Количество = $orderForDelivery['Количество'] ?? null;
        $this->Номенклатура = $orderForDelivery['Номенклатура'] ?? null;
    }
}