<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\StockMovementType;

/**
 * Class UpdateStockMovementTypeRequest
 *
 */
class UpdateStockMovementTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return StockMovementType::$updateRules;
    }
}
