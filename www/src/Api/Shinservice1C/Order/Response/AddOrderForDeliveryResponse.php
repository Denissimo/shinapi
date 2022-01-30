<?php

namespace App\Api\Shinservice1C\Order\Response;

use DateTimeImmutable;

class AddOrderForDeliveryResponse
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var DateTimeImmutable
     */
    public $createdAt;

    /**
     * AddUserDocumentResponse constructor.
     *
     * @param array $orderForDelivery
     */
    public function __construct(array $orderForDelivery)
    {
        $this->id = $orderForDelivery['id'] ?? null;
        $this->createdAt = $orderForDelivery['cretedAt'] ?? null;
    }
}