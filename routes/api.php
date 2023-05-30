<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogAnalyticController;
use App\Models\LogAnalytic;

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

Route::group(
    [
        'prefix' => '/v1'
    ],
    function () {
        Route::apiResource('/log', LogAnalyticController::class)->only(['index', 'show']);
        Route::get('/detail', [LogAnalyticController::class, 'getLogAnalyticByFilter']);
    }
);
