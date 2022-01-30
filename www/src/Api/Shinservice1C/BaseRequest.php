<?php

namespace App\Api\Shinservice1C;

use DateTime;
use DateTimeInterface;

class BaseRequest
{
    /**
     * @param array $date
     *
     * @return DateTime|null
     */
    protected function createDate(array $date): ?DateTime
    {
        if(!isset($date['date'])) {
            return null;
        }

        $dateCut = substr($date['date'], 0, 10);
        $dateTime = DateTime::createFromFormat(
            'Y-m-d',
            $dateCut
        )->setTime(0,0,0);

        return $dateTime instanceof DateTimeInterface ? $dateTime : null;
    }
}