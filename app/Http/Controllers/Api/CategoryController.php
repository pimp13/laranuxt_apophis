<?php

namespace App\Http\Controllers\Api;

use App\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\ArticleCategory;
use App\Services\Caching;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private Caching $cache;

    public function __construct(Caching $caching)
    {
        $this->cache = $caching;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ArticleCategory::latest()->get();
        $this->cache->store('categories_all', $categories);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:70|min:4',
            'description' => 'required|string|max:160|min:4',
            'is_active' => 'nullable|in:0,1|boolean|numeric',
        ]);

        ArticleCategory::create($validate);
        $this->cache->forget('categories_all');
        return ApiResponse::success($validate, 'category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
