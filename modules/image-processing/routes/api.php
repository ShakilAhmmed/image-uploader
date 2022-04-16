<?php

use Illuminate\Support\Facades\Route;
use ShakilAhmmed\ImageUploader\ImageProcessing\Controllers\API\V1\ImageProcessingController;


Route::group(['prefix' => '/api/v1/'], function () {
    Route::group(['prefix' => 'images', 'middleware' => 'auth:api'], function () {
        Route::get('/', [ImageProcessingController::class, 'index']);
        Route::post('/download', [ImageProcessingController::class, 'download']);
    });
});
