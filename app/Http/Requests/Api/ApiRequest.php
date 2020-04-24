<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helpers\ResponseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class ApiRequest
 *
 */
class ApiRequest extends FormRequest
{
    /**
     * Get the proper failed validation response for the request.
     *
     * @param array $errors
     * @return Response|JsonResponse
     */
    public function response(array $errors): JsonResponse
    {
        $messages = implode(' ', Arr::flatten($errors));
        return Response::json(ResponseController::makeError($messages));
    }

    /**
     * @inheritDoc
     */
    protected function failedValidation(Validator $validator): void
    {
        $validationException = new ValidationException($validator);
        $validationException->response = $this->response($validator->errors()->toArray());
        throw ($validationException)->errorBag($this->errorBag);
    }
}
