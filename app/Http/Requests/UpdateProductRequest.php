<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use Illuminate\Validation\Rule;

/**
 * Class UpdateProductRequest
 *
 */
class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->route()->parameter('product')>0) {
            return array_merge(
                Product::$updateRules,
                [
                    'code' =>  [
                        'required',
                        'max:30',
                        Rule::unique('products')
                            ->ignore($this->route()->parameter('product')),
                    ]
                ]
            );
        } else {
            return Product::$updateRules;
        }
    }
}
