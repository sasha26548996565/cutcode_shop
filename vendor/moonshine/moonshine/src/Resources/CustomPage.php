<?php

declare(strict_types=1);

namespace MoonShine\Resources;

use Closure;
use MoonShine\Traits\Makeable;
use MoonShine\Traits\WithLabel;

/**
 * @method static static make(string $title, string $alias, string|Closure $view, Closure|null $viewData = null)
 */
class CustomPage
{
    use Makeable;
    use WithLabel;

    protected string $layout = 'moonshine::layouts.app';

    protected bool $withTitle = true;

    protected array $breadcrumbs = [];

    public function __construct(
        public string $title,
        protected string $alias,
        protected string|Closure $view,
        protected ?Closure $viewData = null,
    ) {
        $this->setLabel($this->title());
    }

    public function title(): string
    {
        return $this->title;
    }

    public function alias(): string
    {
        return $this->alias;
    }

    public function layout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

    public function withoutTitle(): self
    {
        $this->withTitle = false;

        return $this;
    }

    public function withTitle(): bool
    {
        return $this->withTitle;
    }

    public function breadcrumbs(array $breadcrumbs): self
    {
        $this->breadcrumbs = $breadcrumbs;

        return $this;
    }

    public function getBreadcrumbs(): array
    {
        return collect($this->breadcrumbs)
            ->merge(['#' => $this->label()])
            ->toArray();
    }

    public function getView(): string
    {
        if (is_callable($this->view)) {
            return call_user_func($this->view);
        }

        return $this->view;
    }

    /**
     * Get an array of datas
     *
     * @return array<mixed>
     */
    public function datas(): array
    {
        return [];
    }

    public function getViewData(): array
    {
        return is_callable($this->viewData) ? call_user_func($this->viewData)
            : $this->datas();
    }

    public function url(): string
    {
        return route(
            (string) str('moonshine')
                ->append('.')
                ->append('custom_page'),
            $this->alias
        );
    }
}
