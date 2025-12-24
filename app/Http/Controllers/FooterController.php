<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FooterService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FooterController extends Controller
{
    protected FooterService $service;

    public function __construct(FooterService $service)
    {
        $this->service = $service;
    }

    /**
     * GET /api/footer?lang=ru|kk|en
     */
    public function index(Request $request): JsonResponse
    {
        $locale = $request->get('lang', 'ru');

        return response()->json(
            $this->service->get($locale)
        );
    }
}
