<?php

namespace App\Http\Requests\Api;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class CreateStockRemovalApiRequest
 *
 */
class CreateStockRemovalApiRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(
            StockMovement::$createRules,
            [
                'amount' =>  [
                    'required',
                    'numeric',
                    'gt:0',
                    'max:'.Product::find($this->all()['product_id'])->availableAmount()
                ]
            ]
        );
    }

    /**
     * @inheritDoc
     *
     * Get complementary attributes, add them to the request and pass them to the validator instance.
     * Remove the attribute code from the request
     */
    protected function getValidatorInstance(): Validator
    {
        $this->getInputSource()->remove('code');
        $this->getInputSource()->replace(
            array_merge(
                $this->all(),
                $this->getProductIdByCode(),
                $this->getStockMovementType(),
                $this->getAuthenticatedUser(),
                $this->getApiDataSource()
            )
        );
        return parent::getValidatorInstance();
    }

    /**
     * Prepare the attribute stock_movement_type_id with the Id of the removal type of stock movement.
     *
     * @return array
     */
    protected function getStockMovementType(): array
    {
        return ['stock_movement_type_id' => config('stock.fk_removed')];
    }

    /**
     * Prepare the attribute product_id with the Id of the product found by code.
     *
     * @return array
     */
    protected function getProductIdByCode(): array
    {
        if (empty($this->request->get('code'))) {
            $productId = null;
        } else {
            $product = Product::all()->where('code', $this->request->get('code'))->first();
            $productId = ($product!==null) ? $product->id : null;
        }
        return ['product_id' => $productId];
    }

    /**
     * Prepare the attribute user_id with the Id of the authenticated user.
     *
     * @return array
     */
    protected function getAuthenticatedUser(): array
    {
        return ['user_id' => auth()->user()->id];
    }

    /**
     * Prepare the attribute data_source_id with the Id of the web app data source.
     *
     * @return array
     */
    public function getApiDataSource(): array
    {
        return ['data_source_id' => config('stock.fk_api')];
    }
}
