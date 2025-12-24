<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{
    protected FaqService $service;

    public function __construct(FaqService $service)
    {
        $this->service = $service;
    }

    /**
     * GET /api/faqs?lang=ru|kk|en
     */
    public function index(Request $request): JsonResponse
    {
        $locale = $request->get('lang', 'ru');

        return response()->json(
            $this->service->get($locale)
        );
    }
}
