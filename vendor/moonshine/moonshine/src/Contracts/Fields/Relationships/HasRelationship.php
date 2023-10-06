<?php

declare(strict_types=1);

namespace MoonShine\Contracts\Fields\Relationships;

interface HasRelationship
{
    public function relation(): ?string;
}
