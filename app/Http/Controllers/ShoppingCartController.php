<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddShoppingCartItemRequest;
use App\Http\Requests\RemoveShoppingCartItemRequest;
use App\Http\Resources\ShoppingCartItemResource;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ShoppingCartController extends Controller
{

    public function addItem(AddShoppingCartItemRequest $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = $user->shoppingCart ?? $user->shoppingCart()->create();

        $shoppingCart->items()->create([
            'product_id' => $request->getProductId(),
            'quantity' => $request->getQuantity()
        ]);
        $shoppingCart->load([
            'items',
            'items.product.category'
        ]);

        return ShoppingCartItemResource::collection($shoppingCart->items);
    }

    public function removeItem(RemoveShoppingCartItemRequest $request)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = $request->user()->shoppingCart;
        if (!$shoppingCart) {
            throw new UnprocessableEntityHttpException('No shopping cart found');
        }

        $shoppingCart->items()->where([
            'product_id' => $request->getProductId()
        ])->delete();
        if ($shoppingCart->items()->doesntExist()) {
            $shoppingCart->delete();
        } else {
            $shoppingCart->load([
                'items',
                'items.product.category'
            ]);
        }

        return ShoppingCartItemResource::collection($shoppingCart->items);
    }

    public function clear(Request $request)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = $request->user()->shoppingCart;
        if (!$shoppingCart) {
            throw new UnprocessableEntityHttpException('No shopping cart found');
        }

        $shoppingCart->items()->delete();
        $shoppingCart->delete();

        return response()->json();
    }

    public function getItems(Request $request)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = $request->user()->shoppingCart;
        $shoppingCart?->load([
            'items',
            'items.product.category'
        ]);

        return ShoppingCartItemResource::collection($shoppingCart ? $shoppingCart->items : collect());
    }
}
