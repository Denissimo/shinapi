<?php

namespace App\Api\Shinservice1C;

use Doctrine\ORM\EntityManagerInterface;

interface HandlerInterface
{
    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;

    public function handle(RequestHandlerInterface $request);
}