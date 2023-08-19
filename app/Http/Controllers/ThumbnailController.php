<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ThumbnailPicker;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    private ThumbnailPicker $thumbnailPicker;

    public function __construct(ThumbnailPicker $thumbnailPicker)
    {
        $this->thumbnailPicker = $thumbnailPicker;
    }

    public function __invoke(string $directory, string $method, string $size, string $file): BinaryFileResponse
    {
        abort_if(
            in_array($size, config('thumbnail.allowed_sizes')) == false,
            Response::HTTP_FORBIDDEN,
            'Размер недействителен!'
        );

        $path = $this->thumbnailPicker->generate($directory, $method, $size, $file);

        return response()->file($path);
    }
}
