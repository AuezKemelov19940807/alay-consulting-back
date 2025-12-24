<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OperatingAlgorithmService;
use Illuminate\Http\Request;

class OperatingAlgorithmController extends Controller
{
    public function __construct(
        protected OperatingAlgorithmService $service
    ) {}

    /**
     * GET /api/operating-algorithm?lang=ru|kk|en
     */
    public function index(Request $request)
    {
        $locale = $request->get('lang', 'ru');

        return response()->json(
            $this->service->get($locale)
        );
    }
}
