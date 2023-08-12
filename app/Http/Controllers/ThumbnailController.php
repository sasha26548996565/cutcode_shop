<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ThumbnailController extends Controller
{
    public function __invoke(string $directory, string $method, string $size, string $file): BinaryFileResponse
    {
        abort_if(
            in_array($size, config('thumbnail.allowed_sizes')) == false,
            Response::HTTP_FORBIDDEN,
            'Размер недействителен!'
        );

        $storage = Storage::disk('images');
        $realPath = "$directory/$file";
        $newPath = "$directory/$method/$size";
        $resultPath = "$newPath/$file";

        if ($storage->exists($newPath) == false)
        {
            $storage->makeDirectory($newPath);
        }

        if ($storage->exists($resultPath) == false)
        {
            $image = Image::make($storage->path($realPath));
            [$width, $height] = explode('x', $size);
            $image->{$method}($width, $height);
            $image->save($storage->path($resultPath));
        }

        return response()->file($storage->path($resultPath));
    }
}
