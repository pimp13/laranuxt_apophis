<?php

namespace App\Http\Controllers\Api;

use App\Facades\ApiResponse;
use App\Facades\Caching;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\ArticleCategory;
use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $cacheKeyAllData = 'categories.all';

    /**
     * HTTP GET
     * api/category
     */
    public function index(ApiResponse $response): JsonResponse
    {
        $categories = ArticleCategory::latest()->get();
        Caching::rememberNoCallback($this->cacheKeyAllData, $categories);
        if ($categories->count() == 0) {
            return $response::noContent("No Categories Available");
        }
        return $response::success(CategoryResource::collection($categories));
    }

    /**
     * HTTP POST
     * api/category
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $createdCategory = ArticleCategory::create($request->validated());
        // $this->cache->forget(self::cacheKeyAllData);
        return ApiResponse::success(new CategoryResource($createdCategory));
    }

    /**
     * HTTP GET
     * api/category/{id}
     */
    public function show(ArticleCategory $category): JsonResponse
    {
        $cacheKey = "category.{$category->id}";
        // Get cached data if it exists
        if (Caching::has($cacheKey)) {
            $dataCached = Caching::get($cacheKey);
            return ApiResponse::success(new CategoryResource($dataCached));
        }
        Caching::store($cacheKey, $category);
        return ApiResponse::success(new CategoryResource($category));
    }

    /**
     * HTTP PUT/PTACH
     * api/category/{id}
     */
    public function update(CategoryRequest $request, ArticleCategory $category): JsonResponse
    {
        $category->update($request->validated());
        // Caching updated data
        $cacheKey = "category.{$category->id}";
        if (Caching::has($cacheKey)) {
            $dataCached = Caching::get($cacheKey);
            return ApiResponse::success(new CategoryResource($dataCached));
        }
        Caching::store($cacheKey, $category);
        return ApiResponse::success(new CategoryResource($category));
    }

    /**
     * HTTP DELETE
     * api/category/{id}
     */
    public function destroy(ArticleCategory $category)
    {
        $cacheKey = "category.{$category->id}";
        if (Caching::has($cacheKey)) {
            Caching::forget($cacheKey);
        }
        $category->delete();
        return ApiResponse::success(new CategoryResource($category));
    }
}
