<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexNewsRequest;
use App\Models\News;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    /**
     * @param IndexNewsRequest $request
     * @return JsonResponse
     */
    public function index(IndexNewsRequest $request): JsonResponse
    {
        $result = News::FastSearch($request->get("keyword"));
        return response_ok($result);
    }
}
