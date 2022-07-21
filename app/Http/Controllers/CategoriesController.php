<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoriesController extends Controller
{

    public function create(CreateUpdateCategoryRequest $request): CategoryResource
    {
        $category = Category::query()->create([
            'title' => $request->getTitle()
        ]);

        return new CategoryResource($category);
    }

    public function update(CreateUpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $category->update([
            'title' => $request->getTitle()
        ]);

        return new CategoryResource($category);
    }

    public function getAll(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::query()->paginate());
    }
}
