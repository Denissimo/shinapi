<?php

namespace App\Api\Shinservice1C\Order\Response;

use App\Entity\OrderForDelivery as OrderForDeliveryEntity;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class AddOrderForDeliveryResponse
{
    /**
     * @var Uuid
     */
    public $id;

    /**
     * @var DateTimeImmutable
     */
    public $createdAt;

    /**
     * AddUserDocumentResponse constructor.
     *
     * @param OrderForDeliveryEntity $orderForDelivery
     */
    public function __construct(OrderForDeliveryEntity $orderForDelivery)
    {
        $this->id = $orderForDelivery->getId();
        $this->createdAt = $orderForDelivery->getCreatedAt();
    }
}