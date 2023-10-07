<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

use App\Models\ProductProperty;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\BelongsTo;

class PropertyProductsResource extends Resource
{
	public static string $model = ProductProperty::class;

	public static string $title = 'PropertyProducts';
    
    public static array $with = [
        'products',
        'properties'
    ];

    public string $titleField = 'value';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('value'),

            BelongsTo::make('products')
                ->hideOnIndex(),
            BelongsTo::make('properties')
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
