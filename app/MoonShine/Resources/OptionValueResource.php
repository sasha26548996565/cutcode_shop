<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

use App\Models\OptionValue;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\BelongsTo;

class OptionValueResource extends Resource
{
	public static string $model = OptionValue::class;

	public static string $title = 'OptionValues';

    public string $titleField = 'title';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Title'),
            BelongsTo::make('option', new OptionResource())
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
