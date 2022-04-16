<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing\Controllers\API\V1;


use App\Http\Controllers\Controller;
use ShakilAhmmed\ImageUploader\ImageProcessing\Jobs\ImageDownloadJob;
use ShakilAhmmed\ImageUploader\ImageProcessing\Models\Image;
use ShakilAhmmed\ImageUploader\ImageProcessing\Requests\ImageProcessingFormRequest;
use ShakilAhmmed\ImageUploader\ImageProcessing\Resources\ImageResource;
use Symfony\Component\HttpFoundation\Response;

class ImageProcessingController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $images = Image::query()->get();
        $collection = ImageResource::collection($images);
        return $this->successResponse($collection, 'image fetched successfully', Response::HTTP_OK);
    }

    public function download(ImageProcessingFormRequest $request)
    {
        $data = [
            'image_url' => $request->get('image_url'),
            'user_id' => auth()->id()
        ];
        ImageDownloadJob::dispatch($data);
    }
}
