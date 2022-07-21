<?php

namespace App\Http\Resources;

use App\Models\ShoppingCartItem;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ShoppingCartItemResource extends JsonResource
{

    /**
     * @var ShoppingCartItem
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['product'] = new ProductResource($this->whenLoaded('product'));

        return $data;
    }
}
