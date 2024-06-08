<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AccountsController;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\api\AuthController;

Route::resource('/accounts', AccountsController::class, ['only' => ['store','index']]);
Route::post('/auth/signin',[AuthController::class, 'signin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/accounts', AccountsController::class, ['except' => ['store','index']]);
    Route::resource('/image', ImageController::class, ['except' => ['index']]);
});
Route::resource('/image', ImageController::class, ['only' => ['index']]);

