<?php

namespace App\Api\Shinservice1C\Sale\DTO;

use App\Api\Shinservice1C\BaseRequest;
use stdClass;

class Goods extends BaseRequest
{
    /**
     * @var integer
     */
    public $Количество;

    /**
     * @var string
     */
    public $Номенклатура;

    /**
     * Goods constructor.
     *
     * @param stdClass $goods
     */
    public function __construct(stdClass $goods)
    {
        $this->Количество = $goods->Количество ?? null;
        $this->Номенклатура = $goods->Номенклатура ?? null;
    }
}