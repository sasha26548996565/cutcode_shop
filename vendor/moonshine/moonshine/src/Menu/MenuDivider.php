<?php

declare(strict_types=1);

namespace MoonShine\Menu;

use MoonShine\Contracts\Menu\MenuElement;
use MoonShine\Traits\Makeable;

/**
 * @method static static make(string $label = '')
 */
class MenuDivider extends MenuSection implements MenuElement
{
    use Makeable;

    final public function __construct(string $label = '')
    {
        $this->setLabel($label);
    }

    public function isActive(): bool
    {
        return false;
    }
}
