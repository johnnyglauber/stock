<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Class ApiController
 *
 */
class ApiController extends Controller
{
    /**
     * Send proper response for the api request.
     *
     * @param mixed $result
     * @param string $message
     * @return Response|JsonResponse
     */
    public function sendResponse($result, string $message): JsonResponse
    {
        return Response::json(ResponseController::makeResponse($message, $result));
    }
}
