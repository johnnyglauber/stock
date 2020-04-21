<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class StockMovementType
 *
 * @property string name
 */
class StockMovementType extends Model
{
    use SoftDeletes;

    /**
     * @inheritDoc
     */
    public $fillable = [
        'name'
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules for creating
     *
     * @var array
     */
    public static $createRules = [
        'name' => 'required|max:255'
    ];

    /**
     * Validation rules for updating
     *
     * @var array
     */
    public static $updateRules = [
        'name' => 'required|max:255'
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
}
