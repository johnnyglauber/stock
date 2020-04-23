<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

/**
 * Class CreateProductRequest
 *
 */
class CreateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return Product::$createRules;
    }

    /**
     * @inheritDoc
     *
     * Pass the modified request with custom attributes to the validator instance.
     */
    protected function getValidatorInstance(): Validator
    {
        $this->getAuthenticatedUser();
        return parent::getValidatorInstance();
    }

    /**
     * Add the attribute user_id with the Id of the authenticated user to the request.
     *
     * @return void
     */
    protected function getAuthenticatedUser(): void
    {
        $this->request->add(['user_id' => auth()->user()->id]);
    }
}
