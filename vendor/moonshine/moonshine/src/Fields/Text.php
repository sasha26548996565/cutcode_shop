<?php

declare(strict_types=1);

namespace MoonShine\Fields;

use MoonShine\Contracts\Fields\DefaultValueTypes\DefaultCanBeString;
use MoonShine\Contracts\Fields\HasDefaultValue;
use MoonShine\Traits\Fields\WithDefaultValue;
use MoonShine\Traits\Fields\WithInputExtensions;
use MoonShine\Traits\Fields\WithMask;

class Text extends Field implements HasDefaultValue, DefaultCanBeString
{
    use WithInputExtensions;
    use WithMask;
    use WithDefaultValue;

    protected static string $view = 'moonshine::fields.input';

    protected string $type = 'text';
}
