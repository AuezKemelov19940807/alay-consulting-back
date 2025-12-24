<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WhyChooseUsService;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    protected WhyChooseUsService $service;

    public function __construct(WhyChooseUsService $service)
    {
        $this->service = $service;
    }

    /**
     * Получить данные для фронтенда.
     */
    public function index(Request $request)
    {
        $locale = $request->get('locale', 'ru');
        $data = $this->service->getFirst($locale);

        return response()->json($data);
    }
}
