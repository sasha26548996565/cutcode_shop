<?php

declare(strict_types=1);

namespace MoonShine\Fields;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Stringable;
use Illuminate\Support\Traits\Conditionable;
use MoonShine\Contracts\Fields\HasAssets;
use MoonShine\Contracts\Fields\HasCurrentResource;
use MoonShine\Contracts\Fields\HasDefaultValue;
use MoonShine\Contracts\Fields\HasFields;
use MoonShine\Contracts\Fields\Relationships\BelongsToRelation;
use MoonShine\Contracts\Fields\Relationships\HasRelatedValues;
use MoonShine\Contracts\Fields\Relationships\HasRelationship;
use MoonShine\Contracts\Fields\Relationships\HasResourceMode;
use MoonShine\Contracts\ResourceRenderable;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Helpers\Condition;
use MoonShine\MoonShine;
use MoonShine\Traits\Fields\ShowWhen;
use MoonShine\Traits\Fields\WithRelatedValues;
use MoonShine\Traits\Fields\WithResourceMode;
use MoonShine\Traits\Fields\XModel;
use MoonShine\Traits\HasCanSee;
use MoonShine\Traits\Makeable;
use MoonShine\Traits\WithAssets;
use MoonShine\Traits\WithHint;
use MoonShine\Traits\WithHtmlAttributes;
use MoonShine\Traits\WithLabel;
use MoonShine\Traits\WithView;
use MoonShine\Utilities\AssetManager;

/**
 * @method static static make(string|null $label = null, string|null $field = null, Closure|ResourceContract|string|null $resource = null)
 *
 * @mixin WithResourceMode
 * @mixin WithRelatedValues
 */
abstract class FormElement implements ResourceRenderable, HasAssets
{
    use Makeable;
    use WithLabel;
    use WithHtmlAttributes;
    use WithView;
    use WithHint;
    use WithAssets;
    use ShowWhen;
    use HasCanSee;
    use XModel;
    use Conditionable;

    protected string $field;

    protected ?string $relation = null;

    protected ?ResourceContract $resource = null;

    protected ?Field $parent = null;
    protected bool $group = false;

    protected string $resourceTitleField = '';

    protected ?Closure $valueCallback = null;

    protected bool $nullable = false;

    protected bool $fieldContainer = true;

    /**
     * @deprecated Will be deleted
     */
    protected bool $fullWidth = false;

    protected ?string $parentRequestValueKey = null;

    protected ?string $name = null;

    protected ?string $id = null;

    final public function __construct(
        string $label = null,
        string $field = null,
        Closure|ResourceContract|string|null $resource = null
    ) {
        $this->setLabel(trim($label ?? (string) str($this->label)->ucfirst()));
        $this->setField(
            trim($field ?? (string) str($this->label)->lower()->snake())
        );

        if ($this->hasRelationship()) {
            $this->setField($field ?? (string) str($this->label)->camel());

            if ($this->belongToOne() && ! str($this->field())->contains(
                '_id'
            )) {
                $this->setField(
                    (string) str($this->field())
                        ->append('_id')
                        ->snake()
                );
            }

            $this->setRelation($field ?? (string) str($this->label)->camel());

            if (str($this->relation())->contains('_id')) {
                $this->setRelation(
                    (string) str($this->relation())
                        ->remove('_id')
                        ->camel()
                );
            }

            if ($resource instanceof ResourceContract) {
                $this->setResource($resource->relatable());
            } elseif (is_string($resource)) {
                $this->setResourceTitleField($resource);
            }
        }

        if ($resource instanceof Closure) {
            $this->setValueCallback($resource);
        }
    }

    public function setField(string $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function hasRelationship(): bool
    {
        return $this instanceof HasRelationship;
    }

    public function belongToOne(): bool
    {
        return $this->hasRelationship() && $this instanceof BelongsToRelation;
    }

    public function field(): string
    {
        return $this->field;
    }

    public function setRelation(string $relation): static
    {
        $this->relation = $relation;

        return $this;
    }

    public function relation(): ?string
    {
        return $this->relation;
    }

    public function setResource(?ResourceContract $resource): void
    {
        $this->resource = $resource;
    }

    public function setResourceTitleField(string $resourceTitleField): static
    {
        $this->resourceTitleField = trim($resourceTitleField);

        return $this;
    }

    protected function setValueCallback(Closure $valueCallback): void
    {
        $this->valueCallback = $valueCallback;
    }

    public function setResources(ResourceContract $resource): static
    {
        if ($this instanceof HasFields) {
            $fields = [];

            foreach ($this->getFields() as $field) {
                $field = $field->setResources($resource);

                if ($field instanceof HasCurrentResource) {
                    $field->setResource($resource);
                }

                $fields[] = $field;
            }

            $this->fields($fields);
        } elseif ($this instanceof HasCurrentResource) {
            $this->setResource($resource);
        }

        return $this;
    }

    public function resourceTitleField(): string
    {
        if ($this->resourceTitleField !== '' && $this->resourceTitleField !== '0') {
            return $this->resourceTitleField;
        }

        return $this->resource() && $this->resource()->titleField()
            ? $this->resource()->titleField()
            : 'id';
    }

    public function resource(): ?ResourceContract
    {
        return $this->resource ?? $this->findResource();
    }

    protected function findResource(): ?ResourceContract
    {
        if (isset($this->resource)) {
            return $this->resource;
        }

        if (! $this->relation()) {
            return null;
        }

        return MoonShine::getResourceFromUriKey(
            str($this->relation())
                ->singular()
                ->append('Resource')
                ->kebab()
                ->value()
        );
    }

    public function valueCallback(): ?Closure
    {
        return $this->valueCallback;
    }

    public function nullable(Closure|bool|null $condition = null): static
    {
        $this->nullable = Condition::boolean($condition, true);

        return $this;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }

    public function parent(): ?Field
    {
        return $this->parent;
    }

    public function hasParent(): bool
    {
        return $this->parent instanceof self;
    }

    public function setParents(): static
    {
        if ($this instanceof HasFields) {
            $fields = [];

            foreach ($this->getFields() as $field) {
                $field = $field->setParents();

                $fields[] = $field->setParent($this);
            }

            $this->fields($fields);
        }

        return $this;
    }

    protected function setParent(Field $field): static
    {
        $this->parent = $field;

        return $this;
    }

    public function id(string $index = null): string
    {
        if ($this->id) {
            return $this->id;
        }

        return (string) str($this->name ?? $this->name())
            ->replace(['[', ']'], '_')
            ->replaceMatches('/\${index\d+}/', '')
            ->replaceMatches('/_{2,}/', '_')
            ->trim('_')
            ->snake()
            ->when(
                ! is_null($index),
                fn (Stringable $str): Stringable => $str->append("_$index")
            );
    }

    public function name(string $index = null): string
    {
        return $this->prepareName($index);
    }

    protected function prepareName($index = null, $wrap = null): string
    {
        if ($this->name) {
            return $this->name;
        }

        return (string) str($this->field())
            ->when(
                ! is_null($wrap),
                fn (Stringable $str): Stringable => $str->wrap("{$wrap}[", "]")
            )
            ->when(
                $this->isGroup() || $this->getAttribute('multiple'),
                fn (Stringable $str): Stringable => $str->append(
                    "[" . ($index ?? '') . "]"
                )
            );
    }

    public function isGroup(): bool
    {
        return $this->group;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setId(string $id): static
    {
        $this->id = (string) str($id)->remove(['[', ']'])->snake();

        return $this;
    }

    public function isResourceModeField(): bool
    {
        return $this->canBeResourceMode() && $this->isResourceMode();
    }

    public function canBeResourceMode(): bool
    {
        return $this instanceof HasResourceMode;
    }

    /**
     * Set field label block view on forms, based on condition
     * @deprecated Will be deleted
     */
    public function fullWidth(mixed $condition = null): static
    {
        $this->fullWidth = Condition::boolean($condition, true);

        return $this;
    }

    /**
     * @deprecated Will be deleted
     */
    public function isFullWidth(): bool
    {
        return $this->fullWidth;
    }

    public function fieldContainer(mixed $condition = null): static
    {
        $this->fieldContainer = Condition::boolean($condition, true);

        return $this;
    }

    public function hasFieldContainer(): bool
    {
        return $this->fieldContainer;
    }

    public function hasRelatedValues(): bool
    {
        return $this instanceof HasRelatedValues;
    }

    public function getRelated(Model $model): Model
    {
        return $model->{$this->relation()}()->getRelated();
    }

    public function setParentRequestValueKey(?string $key): static
    {
        $this->parentRequestValueKey = $key;

        return $this;
    }

    public function requestValue(string|int|null $index = null): mixed
    {
        $nameDot = str(
            $this->isXModelField() ? $this->field() : $this->nameDot()
        )
            ->when(
                $this->parentRequestValueKey(),
                fn (Stringable $str): Stringable => $str->prepend(
                    "{$this->parentRequestValueKey()}."
                )
            )
            ->when(
                ! is_null($index) && $index !== '',
                fn (Stringable $str): Stringable => $str->append(".$index")
            )->value();

        $default = $this instanceof HasDefaultValue
            ? $this->getDefault()
            : false;

        return request($nameDot, $default) ?? false;
    }

    protected function nameDot(): string
    {
        $name = (string) str($this->name())->replace('[]', '');

        parse_str($name, $array);

        $result = collect(Arr::dot(array_filter($array)));

        return $result->isEmpty()
            ? $name
            : (string) str($result->keys()->first());
    }

    public function parentRequestValueKey(): ?string
    {
        return $this->parentRequestValueKey;
    }

    protected function afterMake(): void
    {
        if ($this->getAssets()) {
            app(AssetManager::class)->add($this->getAssets());
        }
    }

    protected function group(): static
    {
        $this->group = true;

        return $this;
    }
}
