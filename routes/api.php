<?php

use App\Http\Controllers\Pix\PixController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create-pix', [PixController::class, 'createStaticQrCode']);
