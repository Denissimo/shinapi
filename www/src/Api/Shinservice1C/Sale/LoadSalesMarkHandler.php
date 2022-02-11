<?php

namespace App\Api\Shinservice1C\Sale;

use App\Api\ApiResponse;
use App\Api\Shinservice1C\Sale\DTO\Goods;
use App\Api\Shinservice1C\Sale\DTO\Mark;
use App\Api\Shinservice1C\Sale\Request\LoadSalesMarkRequest;
use App\Api\Shinservice1C\Sale\Response\LoadSalesMarkResponse;
use App\Api\Shinservice1C\AbstractHandler;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use App\Api\EntityResponse;

class LoadSalesMarkHandler extends AbstractHandler
{
    public function handle(LoadSalesMarkRequest $request): Response
    {
        try {
            $salesMarks = $this->client->sendJson(
                'UploadSalesMark',
                null,
                null,
                ['DocumentNumber' => $request->id]
            );

            $m = $salesMarks->Марки;
            $g = $salesMarks->Товары;
            $isMarks = isset($salesMarks->Марки) && is_array($salesMarks->Марки);
            $marksList = $isMarks ? array_map(
                function ($mark) {
                    return new Mark($mark);
                },
                $salesMarks->Марки
            ) : [];

            $isGoods = isset($salesMarks->Товары) && is_array($salesMarks->Товары);
            $goodsList = $isGoods ? array_map(
                function ($good) {
                    return new Goods($good);
                },
                $salesMarks->Товары
            ) : [];



            $response = new EntityResponse(
                $loadSalesMarkResponse,
                null,
                ['Access-Control-Allow-Origin' => '*'],
                false
            );
        } catch (Exception $exception) {
            $response = new ApiResponse(
                [
                    'message' => $exception->getMessage()
                ],
                $exception->getCode()
            );
        }

        return $response;
    }
}