<?php

use App\Http\Controllers\ApiV1\Account\CarController;
use App\Http\Controllers\ApiV1\Account\ConversationController;
use App\Http\Controllers\ApiV1\Account\PhoneVerificationController;
use App\Http\Controllers\ApiV1\Account\ProfileController;
use App\Http\Controllers\ApiV1\Account\ReservationController;
use App\Http\Controllers\ApiV1\Account\RouteController;
use App\Http\Controllers\ApiV1\Account\RouteReservationController;
use App\Http\Controllers\ApiV1\Account\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/phone/send-verification-code', [PhoneVerificationController::class, 'sendVerificationCode']);
Route::post('/phone/verify-code', [PhoneVerificationController::class, 'verifyCode']);

Route::middleware('auth:sanctum')->prefix('account')->group(static function () {
    Route::post('/routes/{route}/cancel', [RouteController::class, 'cancel']);
    Route::post('/routes/{route}/reservations/{reservation}/cancel', [RouteReservationController::class, 'cancel']);
    Route::post('/routes/{route}/reservations/{reservation}/confirm', [RouteReservationController::class, 'confirm']);
    Route::apiResource('routes', RouteController::class)->except(['destroy']);

    Route::apiResource('reservations', ReservationController::class)->except(['show', 'update']);

    Route::apiResource('conversations', ConversationController::class)->except(['update', 'destroy']);

    Route::prefix('/profile')->group(static function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('/', [ProfileController::class, 'update']);

        Route::apiResource('cars', CarController::class)->except('show');
    });
});

Route::get('/search', [SearchController::class, 'search']);
