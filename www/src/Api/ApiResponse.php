<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public function __construct($data, int $status = self::HTTP_OK, array $headers = [], bool $json = false)
    {
        if (!$status) {
            $status = self::HTTP_NOT_ACCEPTABLE;
        }

        parent::__construct($data, $status, $headers, $json);
    }
}