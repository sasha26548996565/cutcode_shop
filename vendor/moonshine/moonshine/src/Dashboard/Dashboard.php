<?php

declare(strict_types=1);

namespace MoonShine\Dashboard;

use Illuminate\Support\Collection;
use MoonShine\MoonShine;

class Dashboard
{
    protected ?Collection $blocks = null;

    public function registerBlocks(array $data): void
    {
        $this->blocks = collect();

        collect($data)->each(function ($item): void {
            $item = is_string($item) ? new $item() : $item;

            if ($item instanceof DashboardBlock) {
                $this->blocks->add($item);
            }
        });
    }

    public function getBlocks(): ?Collection
    {
        $class = MoonShine::namespace('\Dashboard');
        $blocks = class_exists($class) ? (new $class())->getBlocks()
            : collect();

        return $this->blocks instanceof Collection ? $this->blocks : $blocks;
    }
}
