<?php

namespace App\Http\Controllers;

use App\Services\OurServiceService;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{
    protected OurServiceService $service;

    public function __construct(OurServiceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $locale = $request->get('lang', 'ru');

        return response()->json(
            $this->service->get($locale)
        );
    }
}
