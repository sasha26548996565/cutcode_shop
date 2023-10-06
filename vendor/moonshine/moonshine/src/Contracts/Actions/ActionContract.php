<?php

declare(strict_types=1);

namespace MoonShine\Contracts\Actions;

interface ActionContract
{
    public function handle(): mixed;

    public function url(): string;

    public function isTriggered(): bool;
}
