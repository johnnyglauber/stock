<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Product
 *
 * @property string name
 * @property string code
 * @property string description
 * @property integer user_id
 */
class Product extends Model
{
    use SoftDeletes;

    /**
     * @inheritDoc
     */
    public $fillable = [
        'name',
        'code',
        'description',
        'user_id'
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'code' => 'string',
        'description' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules for creating
     *
     * @var array
     */
    public static $createRules = [
        'name' => 'required|max:255',
        'code' => 'required|max:30|unique:products',
        'description' => 'max:1000',
        'user_id' => 'required|exists:users,id'
    ];

    /**
     * Validation rules for updating
     *
     * @var array
     * @see UpdateProductRequest::rules() for complementary rules
     */
    public static $updateRules = [
        'name' => 'required|max:255',
        'description' => 'max:1000'
    ];

    /**
     * Relationship with the stock movements table
     *
     * @return HasMany
     **/
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
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
     * Get amount of products placed in stock
     *
     * @return float|null
     **/
    public function placedAmount()
    {
        $fk_placed = config('stock.fk_placed');
        if ($fk_placed > 0) {
            $amount = $this->stockMovements()->where('stock_movement_type_id', $fk_placed)->sum('amount');
            return ($amount > 0) ? $amount : 0;
        }
        return 0;
    }

    /**
     * Get amount of products removed from stock
     *
     * @return float|null
     **/
    public function removedAmount()
    {
        $fk_removed = config('stock.fk_removed');
        if ($fk_removed > 0) {
            $amount = $this->stockMovements()->where('stock_movement_type_id', $fk_removed)->sum('amount');
            return ($amount > 0) ? $amount : 0;
        }
        return 0;
    }

    /**
     * Get amount of products available in stock
     *
     * @return float
     **/
    public function availableAmount()
    {
        $placedAmount = $this->placedAmount();
        $removedAmount = $this->removedAmount();
        if ($placedAmount >= 0 && $removedAmount >= 0) {
            return $placedAmount - $removedAmount;
        } else {
            return 0;
        }
    }
}
