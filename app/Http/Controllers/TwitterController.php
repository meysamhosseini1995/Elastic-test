<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexTwitterRequest;
use App\Models\Twitter;
use Illuminate\Http\JsonResponse;

class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param IndexTwitterRequest $request
     * @return JsonResponse
     */
    public function index(IndexTwitterRequest $request): JsonResponse
    {
        $result = Twitter::FastSearch($request->input('keyword'));
        return response_ok($result);
    }

}
