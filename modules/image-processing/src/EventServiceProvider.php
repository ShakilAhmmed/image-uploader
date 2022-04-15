<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing;

use App\Events\ImageDownloadEvent;
use App\Listeners\ImageDownloadListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ImageDownloadEvent::class => [
            ImageDownloadListener::class,
        ]
    ];

}
