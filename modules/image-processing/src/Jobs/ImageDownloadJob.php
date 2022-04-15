<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ShakilAhmmed\ImageUploader\ImageProcessing\Models\Image;
use ShakilAhmmed\ImageUploader\ImageProcessing\Services\ImageService;

class ImageDownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Image $image)
    {
        $imagePath = ImageService::setUri($this->data['image_url'])->download();
        $attributes = [
            'path' => $imagePath,
            'user_id' => $this->data['user_id']
        ];
        $image->fill($attributes)->save();
    }
}
