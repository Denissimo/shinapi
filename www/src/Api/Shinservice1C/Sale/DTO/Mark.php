<?php

namespace App\Api\Shinservice1C\Sale\DTO;

use App\Api\Shinservice1C\BaseRequest;

class Mark extends BaseRequest
{
    /**
     * @var string
     */
    public $Марка;

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
        $this->Марка = $orderForDelivery['Марка'] ?? null;
        $this->Номенклатура = $orderForDelivery['Номенклатура'] ?? null;
    }
}