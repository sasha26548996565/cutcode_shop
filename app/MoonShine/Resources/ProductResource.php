<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Product;
use MoonShine\Fields\ID;

use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\BelongsTo;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\BelongsToMany;

class ProductResource extends Resource
{
	public static string $model = Product::class;

	public static string $title = 'Products';

    public static array $with = [
        'brand',
        'categories',
        'optionValues',
        'properties',
    ];

    public string $titleField = 'title';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Title'),
            Slug::make('Slug'),

            TinyMce::make('Text')
                ->hideOnIndex(),

            Number::make('price')
                ->hideOnIndex(),

            Number::make('count')
                ->hideOnIndex(),

            Image::make('Thumbnail')
                ->disk('public')
                ->dir('products/resize/345x320')
                ->hideOnIndex(),

            BelongsTo::make('Brand', 'brand', new BrandResource())
                ->hideOnIndex(),
            BelongsToMany::make('Categories', 'categories', new CategoryResource())
                ->hideOnIndex(),
            BelongsToMany::make('Properties', 'properties', new PropertyResource())
                ->hideOnIndex(),
            BelongsToMany::make('Option Values', 'optionValues', new OptionValueResource())
                ->hideOnIndex(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
