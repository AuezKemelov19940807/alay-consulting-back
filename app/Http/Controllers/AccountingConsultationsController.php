<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AccountingConsultationsService;
use Illuminate\Http\Request;

class AccountingConsultationsController extends Controller
{
    public function __construct(
        protected AccountingConsultationsService $service
    ) {}

    /**
     * Получить блок "Получите помощь бухгалтера"
     */
    public function index(Request $request)
    {
        $locale = $request->get('lang', 'ru');

        return response()->json(
            $this->service->getFirst($locale)
        );
    }
}
