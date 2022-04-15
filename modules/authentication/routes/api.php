<?php

use Illuminate\Support\Facades\Route;
use ShakilAhmmed\ImageUploader\Authentication\Controllers\API\V1\AuthenticationController;


Route::group(['prefix' => '/api/v1/'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthenticationController::class, 'login']);
        Route::post('/register', [AuthenticationController::class, 'register']);

        // Accessible if authenticated
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/me', [AuthenticationController::class, 'userInfo']);
            Route::post('/refresh', [AuthenticationController::class, 'refresh']);
            Route::post('/logout', [AuthenticationController::class, 'logout']);
        });
    });
});
