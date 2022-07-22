<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class OrdersController extends Controller
{

    public function create(Request $request): OrderResource
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = $request->user()->shoppingCart;
        if (!$shoppingCart) {
            throw new UnprocessableEntityHttpException('No shopping cart found');
        }
        $shoppingCart->load([
            'items.product.category',
            'items.product.media',
        ]);


        $total = 0;
        $items = [];
        foreach ($shoppingCart->items as $item) {
            $total += $item->quantity * $item->product->price;
            $items[] = (new ProductResource($item->product))->toArray($request);
        }
        /** @var Order $order */
        $order = $request->user()->orders()->create([
            'total' => $total,
            'items' => $items
        ])->refresh();
        $shoppingCart->delete();

        return new OrderResource($order);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order): OrderResource
    {
        $order->update([
            'status' => $request->getStatus()
        ]);

        return new OrderResource($order);
    }

    public function getAll(Request $request): AnonymousResourceCollection
    {
        return OrderResource::collection($request->user()->orders()->paginate());
    }
}
