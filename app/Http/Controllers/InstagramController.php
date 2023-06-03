<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexInstagramRequest;
use App\Models\Instagram;
use Illuminate\Http\JsonResponse;
class InstagramController extends Controller
{
    /**
     * @param IndexInstagramRequest $request
     * @return JsonResponse
     */
    public function index(IndexInstagramRequest $request): JsonResponse
    {
        $result = Instagram::FastSearch($request->input('keyword'));
        return response_ok($result);
    }
}
