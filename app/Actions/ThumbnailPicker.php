<?php

declare(strict_types=1);

namespace App\Actions;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Filesystem\Filesystem;

class ThumbnailPicker
{
    public function generate(string $directory, string $method, string $size, string $file): string
    {
        try
        {
            $storage = Storage::disk('public');
            $newPath = "$directory/$method/$size";
            $resultPath = "$newPath/$file";

            $this->tryMakeDirectory($storage, $newPath);
            $this->trySave($storage, $resultPath, $size, $method, $file);

            return $storage->path($resultPath);
        } catch (\Exception $exception)
        {
            throw new \Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function tryMakeDirectory(Filesystem $storage, string $path): void
    {
        if ($storage->exists($path) == false)
        {
            $storage->makeDirectory($path);
        }
    }

    private function trySave(Filesystem $storage, string $path, string $size, string $method, string $file): void
    {
        if ($storage->exists($path))
        {
            throw new \Exception('File already exists!');
        }

        $image = Image::make($storage->path($file));
        [$width, $height] = explode('x', $size);
        $image->{$method}($width, $height);
        $image->save($storage->path($path));
    }
}
