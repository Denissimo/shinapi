<?php

namespace App\Api\Shinservice1C\Sale\Response;

use App\Api\Shinservice1C\Sale\DTO\Goods;
use App\Api\Shinservice1C\Sale\DTO\Mark;
use stdClass;

class LoadSalesMarkResponse
{
    /**
     * @var string
     */
    public $НомерДокументаРасхода;

    /**
     * @var Goods[]
     */
    public $Товары;

    /**
     * @var Mark[]
     */
    public $Марки;

    /**
     * @var bool
     */
    public $ТолькоПоПереченюМарок;

    /**
     * @param string $НомерДокументаРасхода
     * @param Goods[] $Товары
     * @param Mark[] $Марки
     * @param bool $ТолькоПоПереченюМарок
     */
    public function __construct(string $НомерДокументаРасхода, array $Товары, array $Марки, bool $ТолькоПоПереченюМарок)
    {
        $this->НомерДокументаРасхода = $НомерДокументаРасхода;
        $this->Товары = $Товары;
        $this->Марки = $Марки;
        $this->ТолькоПоПереченюМарок = $ТолькоПоПереченюМарок;
    }
}