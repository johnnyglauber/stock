<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class User
 *
 * @property string name
 * @property string email
 * @property string email_verified_at
 * @property string password
 * @property string remember_token
 */
class User extends Authenticable
{
    use Notifiable, HasApiTokens;

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * @inheritDoc
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * Relationship with the products table
     *
     * @return HasMany
     **/
    public function products()
    {
        return $this->hasMany(Product::class);
    }

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
