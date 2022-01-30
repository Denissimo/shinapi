<?php

namespace App\Api\Shinservice1C;

use App\Api\Validator\InstanceValidator;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var InstanceValidator
     */
    protected $instanceValidator;

    /**
     * LoadApplicationHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->instanceValidator = new InstanceValidator();
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}