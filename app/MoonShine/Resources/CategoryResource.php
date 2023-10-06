<?php

namespace App\MoonShine\Resources;

use App\Models\Category;
use MoonShine\Fields\ID;

use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class CategoryResource extends Resource
{
	public static string $model = Category::class;

	public static string $title = 'Categories';

    public string $titleField = 'title';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Title'),
            Slug::make('Slug'),
            Image::make('Thumbnail')
                ->disk('public')
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
