<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class StockMovement
 *
 * @property integer stock_movement_type_id
 * @property integer product_id
 * @property float amount
 * @property integer user_id
 * @property integer data_source_id
 */
class StockMovement extends Model
{
    use SoftDeletes;

    /**
     * @inheritDoc
     */
    public $fillable = [
        'stock_movement_type_id',
        'product_id',
        'amount',
        'user_id',
        'data_source_id'
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'stock_movement_type_id' => 'integer',
        'product_id' => 'integer',
        'amount' => 'float',
        'user_id' => 'integer',
        'data_source_id' => 'integer'
    ];

    /**
     * Validation rules for creating
     *
     * @var array
     */
    public static $createRules = [
        'stock_movement_type_id' => 'required|exists:stock_movement_types,id',
        'product_type_id' => 'required|exists:products,id',
        'amount' => 'required|numeric|gt:0',
        'user_id' => 'required|exists:users,id',
        'data_source_id' => 'required|exists:data_sources,id'
    ];

    /**
     * Validation rules for updating
     *
     * @var array
     */
    public static $updateRules = [
        'stock_movement_type_id' => 'required|exists:stock_movement_types,id',
        'product_type_id' => 'required|exists:products,id',
        'amount' => 'required|numeric|gt:0',
    ];

    /**
     * Relationship with the stock movement types table
     *
     * @return BelongsTo
     **/
    public function stockMovementType()
    {
        return $this->belongsTo(StockMovementType::class);
    }

    /**
     * Relationship with the products table
     *
     * @return BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship with the users table
     *
     * @return BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with the data sources table
     *
     * @return BelongsTo
     **/
    public function dataSource()
    {
        return $this->belongsTo(DataSource::class);
    }
}
