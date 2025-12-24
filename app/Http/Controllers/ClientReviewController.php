<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ClientReviewService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientReviewController extends Controller
{
    protected ClientReviewService $service;

    public function __construct(ClientReviewService $service)
    {
        $this->service = $service;
    }

    /**
     * GET /api/client-reviews?lang=ru|kk|en
     */
    public function index(Request $request): JsonResponse
    {
        $locale = $request->get('lang', 'ru'); // берём язык из запроса
        $reviews = $this->service->getAll($locale);

        return response()->json($reviews);
    }

    /**
     * GET /api/client-reviews/first?lang=ru|kk|en
     */
    public function first(Request $request): JsonResponse
    {
        $locale = $request->get('lang', 'ru');
        $review = $this->service->getFirst($locale);

        return response()->json($review);
    }
}
