<?php

namespace App\Http\Helpers;

class ResponseController
{
    /**
     * Create array for success response
     *
     * @param string $message
     * @param mixed $data
     * @return array
     */
    public static function makeResponse(string $message, $data): array
    {
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
    }

    /**
     * Create array for error response
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public static function makeError(string $message, array $data = []): array
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        return $response;
    }
}
