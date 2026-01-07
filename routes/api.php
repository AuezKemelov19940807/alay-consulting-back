<?php

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\BitrixController;
use App\Http\Controllers\FooterController;
use Illuminate\Support\Facades\Route;



Route::get('/main', [MainController::class, 'index']);

Route::get('/footer', [FooterController::class, 'index']);

// Bitrix
Route::prefix('bitrix')
    ->controller(BitrixController::class)
    ->group(function () {
        Route::post('contact', 'createContact');
        Route::post('deal', 'createDeal');
        Route::get('deals', 'listDeals');
    });


