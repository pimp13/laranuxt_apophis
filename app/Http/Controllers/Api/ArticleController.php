<?php

namespace App\Http\Controllers\Api;

use App\Facades\ApiResponse;
use App\Facades\Caching;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{   
    /**
     * HTTP GET
     * api/article
     */
    public function index()
    {
        $articles = Article::with([
            'user:id,first_name,last_name,email',
            'category:id,name,description'
        ])->latest()->paginate(15);

        Caching::pagination('articles', $articles);

        return ArticleResource::collection($articles);
    }

    /**
     * HTTP POST
     * api/article
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * HTTP GET
     * api/article/{id}
     */
    public function show(string $id)
    {
        //
    }

    /**
     * HTTP PUT/PATCH
     * api/article/{id}
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * HTTP DELETE
     * api/article/{id}
     */
    public function destroy(string $id)
    {
        //
    }
}
