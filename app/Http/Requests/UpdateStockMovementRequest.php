<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\StockMovement;

/**
 * Class UpdateStockMovementRequest
 *
 */
class UpdateStockMovementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * If it is a removal from stock, than it adds a max amount limit
     *
     * @return array
     */
    public function rules(): array
    {
        $stockMovementId = $this->route()->parameter('stock_movement');
        $stockMovementTypeId = $this->request->get('stock_movement_type_id');
        $productId = $this->request->get('product_id');
        $maxAmount = Product::find($productId)->availableAmount() + StockMovement::find($stockMovementId)->amount;
        if ($stockMovementTypeId == config('stock.fk_removed')) {
            return array_merge(
                StockMovement::$updateRules,
                [
                    'amount' =>  [
                        'required',
                        'numeric',
                        'gt:0',
                        'max:'.$maxAmount
                    ]
                ]
            );
        } else {
            return StockMovement::$updateRules;
        }
    }
}
