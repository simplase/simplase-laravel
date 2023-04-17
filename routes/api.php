<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\FeedbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreUserController;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::prefix('V1')->group(function () {
    Route::prefix('feedback')->group(function (){
        Route::get('/', [FeedbackController::class, 'index']);
        Route::post('/', [FeedbackController::class, 'store']);
        Route::delete('/{id}', [FeedbackController::class, 'destroy'])->middleware('jwt.auth');
    });

    Route::post('create/user', StoreUserController::class,);

});

