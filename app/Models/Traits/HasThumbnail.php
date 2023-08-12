<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Facades\File;

trait HasThumbnail
{
    abstract protected function thumbnailDirectory(): string;

    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        return route('thumbnail', [
            'size' => $size,
            'method' => $method,
            'directory' => $this->thumbnailDirectory(),
            'file' => File::basename($this->{$this->getThumbnailColumnName()}),
        ]);
    }

    private function getThumbnailColumnName(): string
    {
        return 'thumbnail';
    }
}
