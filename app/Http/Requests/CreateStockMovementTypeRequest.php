<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\StockMovementType;

/**
 * Class CreateStockMovementTypeRequest
 *
 */
class CreateStockMovementTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return StockMovementType::$createRules;
    }
}
