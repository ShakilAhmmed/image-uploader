<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing;

use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider as LaravelProvider;
use ShakilAhmmed\ImageUploader\ImageProcessing\Events\ImageDownloadEvent;

class ServiceProvider extends LaravelProvider
{
    protected $rootPath;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->rootPath = realpath(__DIR__ . '/../');
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom($this->rootPath . '/database/migrations');
        $this->loadRoutesFrom($this->rootPath . '/routes/api.php');


        Queue::after(function (JobProcessed $event) {
            $payload = $event->job->payload();
            $data = unserialize($payload['data']['command']);
            $reflectionProperty = new \ReflectionProperty($data, 'data');
            $reflectionProperty->setAccessible(true);
            $properties = $reflectionProperty->getValue($data);
            $message = $properties['image_url'] . "Downloaded Successfully";
            event(new ImageDownloadEvent($message));
        });
    }

}
