<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransactionCallbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [ApiAuthController::class, 'login']);
Route::post('/auth/register', [ApiAuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/auth/logout', [ApiAuthController::class, 'logout']);

Route::get('/mock-response', [TransactionController::class, 'index']);
Route::post('/store-transaction', [TransactionController::class, 'store']);
Route::post('/update-transaction', [TransactionCallbackController::class, 'update']);
