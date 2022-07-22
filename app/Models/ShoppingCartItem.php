<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $quantity
 *
 * @property ShoppingCart $shoppingCart
 * @property Product $product
 */
class ShoppingCartItem extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart_items';

    protected $fillable = [
        'shopping_cart_id',
        'product_id',
        'quantity'
    ];

    public $timestamps = false;

    public function shoppingCart(): BelongsTo
    {
        return $this->belongsTo(ShoppingCart::class, 'shopping_cart_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
