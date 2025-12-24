<?php

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\FooterController;
use Illuminate\Support\Facades\Route;



Route::get('/main', [MainController::class, 'index']);

Route::get('/footer', [FooterController::class, 'index']);


