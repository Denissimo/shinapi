<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

class EntityResponse extends ApiResponse
{
    /**
     * @var string[]
     */
    protected static $messages = [
        self::HTTP_NOT_FOUND => 'Объект %s не найден',
        self::HTTP_NOT_ACCEPTABLE => 'Объект %s имеет неверный формат',
    ];

    /**
     * EntityResponse constructor.
     *
     * @param             $data
     * @param null|string $id
     * @param array       $headers
     * @param bool        $json
     */
    public function __construct($data, string $id = null, array $headers = [], bool $json = true)
    {
        $status = $json ? $this->check($data) : self::HTTP_OK;

        if ($status != self::HTTP_OK) {
            $data = json_encode(
                [
                    'message' => sprintf(self::$messages[$status], $id)
                ]
            );
        }

        parent::__construct($data, $status, $headers, $json);
    }

    /**
     * @param mixed $data
     *
     * @return int
     */
    protected function check($data)
    {
        $result = is_array($data) ? current($data) : $data;

        switch (true) {
            case !is_object($result):

                return self::HTTP_NOT_FOUND;

            case !method_exists($result, '__toString'):

                return self::HTTP_NOT_ACCEPTABLE;

            default:

                return self::HTTP_OK;
        }
    }
}