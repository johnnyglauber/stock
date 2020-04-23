<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\StockMovement;

/**
 * Class CreateStockMovementRequest
 *
 */
class CreateStockMovementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * If it is a removal from stock, than it adds a max amount limit
     *
     * @return array
     */
    public function rules(): array
    {
        $stockMovementTypeId = $this->request->get('stock_movement_type_id');
        $productId = $this->request->get('product_id');
        if ($stockMovementTypeId == config('stock.fk_removed')) {
            return array_merge(
                StockMovement::$createRules,
                [
                    'amount' =>  [
                        'required',
                        'numeric',
                        'gt:0',
                        'max:'.Product::find($productId)->availableAmount()
                    ]
                ]
            );
        } else {
            return StockMovement::$createRules;
        }
    }

    /**
     * @inheritDoc
     *
     * Pass the modified request with custom attributes to the validator instance.
     */
    protected function getValidatorInstance(): Validator
    {
        $this->getAuthenticatedUser();
        $this->getWebAppDataSource();
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

    /**
     * Add the attribute data_source_id with the Id of the web app data source to the request.
     *
     * @return void
     */
    protected function getWebAppDataSource(): void
    {
        $this->request->add(['data_source_id' => config('stock.fk_web')]);
    }
}
