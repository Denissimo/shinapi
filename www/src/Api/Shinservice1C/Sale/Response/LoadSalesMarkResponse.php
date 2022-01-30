<?php

namespace App\Api\Shinservice1C\Sale\Response;

use stdClass;

class LoadSalesMarkResponse
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