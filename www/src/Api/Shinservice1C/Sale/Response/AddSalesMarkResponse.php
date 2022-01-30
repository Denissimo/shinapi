<?php

namespace App\Api\Shinservice1C\Sale\Response;

use DateTimeImmutable;

class AddSalesMarkResponse
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