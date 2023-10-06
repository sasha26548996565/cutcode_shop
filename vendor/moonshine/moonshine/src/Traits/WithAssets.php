<?php

declare(strict_types=1);

namespace MoonShine\Traits;

trait WithAssets
{
    /**
     * @var array<string>
     */
    protected array $assets = [];

    public function getAssets(): array
    {
        return $this->assets;
    }
}
