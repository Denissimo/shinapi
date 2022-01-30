<?php

namespace App\Api\Shinservice1C\Order\Response;

use App\Api\Shinservice1C\Order\DTO\OrderForDelivery;
use App\Api\Shinservice1C\Individual\DTO\Individual;
use App\Api\Shinservice1C\User\DTO\User;
use App\Entity\OrderForDelivery as OrderForDeliveryEntity;
use App\Entity\Individual as IndividualEntity;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class LoadOrderForDeliveryResponse
{
    /**
     * @var Uuid
     */
    public $id;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Individual
     */
    public $head;

    /**
     * @var Individual[]|array
     */
    public $representative;

    /**
     * @var OrderForDelivery
     */
    public $orderForDelivery;

    /**
     * @var DateTimeImmutable
     */
    public $createdAt;

    /**
     * @var DateTimeImmutable
     */
    public $updatedAt;

    /**
     * AddUserDocumentResponse constructor.
     *
     * @param OrderForDeliveryEntity $orderForDelivery
     */
    public function __construct(OrderForDeliveryEntity $orderForDelivery)
    {
        $this->id = $orderForDelivery->getId();
        $this->user = new User($orderForDelivery->getUser());
        $this->head = new Individual($orderForDelivery->getHead());
        $this->representative = $this->listRepresentatives($orderForDelivery);
        $this->orderForDelivery = new OrderForDelivery($orderForDelivery);
        $this->createdAt = $orderForDelivery->getCreatedAt();
        $this->updatedAt = $orderForDelivery->getUpdatedAt();
    }

    private function listRepresentatives(OrderForDeliveryEntity $orderForDelivery)
    {
        return array_map(
            function (IndividualEntity $representative) {
                return new Individual($representative);
            },
            $orderForDelivery->getRepresentative()->toArray()
        );
    }
}