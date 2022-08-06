<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\GetProductsRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsController extends Controller
{

    public function create(CreateProductRequest $request): ProductResource
    {
        /** @var Product $product */
        $product = Product::query()->create($request->getInsertData());

        $image = $request->getImage();
        if ($image) {
            $product->addMainImage($image);
            $product->load('media');
        }
        $product->load('category');

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product->update($request->getInsertData());

        if ($request->shouldDeleteImage()) {
            $product->getMainImage()?->delete();
        }
        $image = $request->getImage();
        if ($image) {
            $product->addMainImage($image);
        }
        $product->load([
            'media',
            'category'
        ]);

        return new ProductResource($product);
    }

    public function delete(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json();
    }

    public function get(Product $product): ProductResource
    {
        $product->load([
            'media',
            'category'
        ]);

        return new ProductResource($product);
    }

    public function getAll(GetProductsRequest $request): AnonymousResourceCollection
    {
        $query = Product::query();

        if ($request->hasOrderBy()) {
            $query->orderBy($request->getOrderBy()->value, $request->getOrderDirection()->value);
        }
        if ($request->hasPriceMin()) {
            $query->where('price', '>=', $request->getPriceMin());
        }
        if ($request->hasPriceMax()) {
            $query->where('price', '<=', $request->getPriceMax());
        }

        return ProductResource::collection($query
            ->with('media', 'category')
            ->paginate());
    }
}
