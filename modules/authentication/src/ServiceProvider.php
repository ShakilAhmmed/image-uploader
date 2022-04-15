<?php

namespace ShakilAhmmed\ImageUploader\Authentication;

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
    }

    public function boot()
    {
        $this->loadMigrationsFrom($this->rootPath . '/database/migrations');
        $this->loadRoutesFrom($this->rootPath . '/routes/api.php');
    }

}
