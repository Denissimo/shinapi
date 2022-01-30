<?php

namespace App\Api\Shinservice1C\Sale\Request;

use App\Api\Shinservice1C\RequestHandlerInterface;
use App\Entity\SonataUserUser;
use Symfony\Component\HttpFoundation\Request;

class LoadSalesMarkRequest implements RequestHandlerInterface
{
    /**
     * @var string
     */
    public $id;

    /**
     * LoadApplicationByIdRequest constructor.
     */
    public function __construct(Request $request)
    {
        $this->id = $request->get('id');
    }
}