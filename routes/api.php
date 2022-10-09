<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
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

Route::prefix('v1')->name('v1.')->middleware('api')->group(function () {

    Route::prefix('auth')->name('auth.')->middleware('auth:api')->group(function () {
        Route::post('/autenticar', [AuthController::class, 'login'])->name('autenticar')->withoutMiddleware('auth:api');
    });
    
    Route::prefix('email')->name('email.')->middleware('auth:api')->group(function () {
        Route::post('/agendar', [MailController::class, 'schedule'])->name('agendar');
        Route::get('/historico', [MailController::class, 'historic'])->name('historico');
    });
    
});
