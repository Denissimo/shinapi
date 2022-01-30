<?php

namespace App\Api\Shinservice1C\Order\Response;

use stdClass;

class LoadOrderForDeliveryResponse
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
     * AddUserDocumentResponse constructor.
     *
     * @param stdClass $orderForDelivery
     */
    public function __construct(stdClass $orderForDelivery)
    {
        $this->Марка = $orderForDelivery->Марка;
        $this->Номенклатура = $orderForDelivery->Номенклатура;
    }
}