<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct(protected BannerService $bannerService) {}

    /**
     * Получить баннер (первый)
     */
    public function index(Request $request)
    {
        // Получаем язык из запроса, по умолчанию 'ru'
        $locale = $request->get('lang', 'ru');

        $banner = $this->bannerService->getFirst($locale);

        return response()->json($banner);
    }
}
