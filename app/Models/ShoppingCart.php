<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $user_id
 *
 * @property User $user
 * @property Collection<ShoppingCartItem>|ShoppingCartItem[] $items
 */
class ShoppingCart extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'shopping_carts';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ShoppingCartItem::class, 'shopping_cart_id', 'id');
    }
}
