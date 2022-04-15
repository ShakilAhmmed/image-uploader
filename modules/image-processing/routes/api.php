<?php

use Illuminate\Support\Facades\Route;
use ShakilAhmmed\ImageUploader\Authentication\Controllers\API\V1\AuthenticationController;
use ShakilAhmmed\ImageUploader\ImageProcessing\Controllers\API\V1\ImageProcessingController;


Route::group(['prefix' => '/api/v1/'], function () {
    Route::group(['prefix' => 'images', 'middleware' => 'auth:api'], function () {
        Route::post('/download', [ImageProcessingController::class, 'download']);
    });
});
