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
        'description' => 'required|max:1000',
        'user_id' => 'required|exists:users,id'
    ];

    /**
     * Validation rules for updating
     *
     * @var array
     */
    public static $updateRules = [
        'name' => 'required|max:255',
        'code' => 'required|max:30|unique:products',
        'description' => 'required|max:1000'
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
}
