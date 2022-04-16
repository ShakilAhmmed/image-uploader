<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing;

use App\Listeners\ImageDownloadListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use ShakilAhmmed\ImageUploader\ImageProcessing\Events\ImageDownloadEvent;

class EventServiceProvider extends ServiceProvider
{

}
