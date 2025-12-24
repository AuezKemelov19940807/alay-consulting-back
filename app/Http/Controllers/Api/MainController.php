<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MainService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(protected MainService $mainService) {}

    public function index(Request $request)
    {
        // Получаем язык из запроса, по умолчанию 'ru'
        $locale = $request->get('lang', 'ru');

        return response()->json([
            'main' => $this->mainService->getMain($locale)
        ]);
    }
}
