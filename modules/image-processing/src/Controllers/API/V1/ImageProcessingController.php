<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing\Controllers\API\V1;


use App\Http\Controllers\Controller;
use ShakilAhmmed\ImageUploader\ImageProcessing\Jobs\ImageDownloadJob;
use ShakilAhmmed\ImageUploader\ImageProcessing\Requests\ImageProcessingFormRequest;

class ImageProcessingController extends Controller
{
    public function download(ImageProcessingFormRequest $request)
    {
        $data = [
            'image_url' => $request->get('image_url'),
            'user_id' => auth()->id()
        ];
        ImageDownloadJob::dispatch($data);
    }
}
