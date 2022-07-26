<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductResource extends JsonResource
{

    /**
     * @var Product
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
        $data['image_url'] = $this->resource->getMainImage()?->getOriginalUrlAttribute();
        $data['category'] =  new CategoryResource($this->whenLoaded('category'));

        return $data;
    }
}
