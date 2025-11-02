<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Chatbot\Controllers\ChatbotController;

Route::post('/chatbot', [ChatbotController::class, 'handleMessage']);