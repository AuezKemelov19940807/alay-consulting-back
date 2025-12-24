<?php

namespace App\Http\Controllers;

use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SeoController extends Controller
{
    protected SeoService $service;

    public function __construct(SeoService $service)
    {
        $this->service = $service;
    }

    /**
     * GET /api/seo?lang=ru|kk|en
     */
    public function index(Request $request): JsonResponse
    {
        $locale = $request->get('lang', 'ru');

        return response()->json(
            $this->service->get($locale)
        );
    }
}
