<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing;

use App\Events\ImageDownloadEvent;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider as LaravelProvider;

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


        Queue::after(function (JobProcessed $jobProcessed) {
            event(new ImageDownloadEvent($jobProcessed->job));
        });
    }

}
