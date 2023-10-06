<?php

use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Select;

uses()->group('fields');

beforeEach(function (): void {
    $this->selectOptions = [
        0 => 1,
        1 => 2,
        2 => 3,
    ];

    $this->field = Select::make('Select')->options($this->selectOptions);

    $this->fieldMultiple = Select::make('Select multiple')
        ->options($this->selectOptions)
        ->multiple();
    $this->item = new class () extends Model {
        public int $select = 1;
        public array $select_multiple = [1];

        protected $casts = [
            'select_multiple' => 'json',
        ];
    };
});

it('type', function (): void {
    expect($this->field->type())
        ->toBeEmpty();
});

it('view', function (): void {
    expect($this->field->getView())
        ->toBe('moonshine::fields.select');
});

it('index view value', function (): void {
    expect($this->field->indexViewValue($this->item))
        ->toBe('2')
        ->and($this->fieldMultiple->indexViewValue($this->item))
        ->toBe(view('moonshine::ui.badge', [
            'color' => 'purple',
            'value' => '2',
        ])->render());
});

it('multiple', function (): void {
    expect($this->field->isMultiple())
        ->toBeFalse()
        ->and($this->fieldMultiple->isMultiple())
        ->toBeTrue();
});

it('searchable', function (): void {
    expect($this->fieldMultiple)
        ->isSearchable()
        ->toBeFalse()
        ->and($this->fieldMultiple->searchable())
        ->isSearchable()
        ->toBeTrue();
});

it('options', function (): void {
    expect($this->fieldMultiple)
        ->values()
        ->toBe($this->selectOptions);
});

it('is selected correctly', function (): void {
    expect($this->fieldMultiple)
        ->isSelected($this->item, '1')
        ->toBeTrue();
});

it('is selected invalid', function (): void {
    expect($this->fieldMultiple)
        ->isSelected($this->item, '2')
        ->toBeFalse();
});

it('names single', function (): void {
    expect($this->field)
        ->name()
        ->toBe('select')
        ->name('1')
        ->toBe('select');
});

it('names multiple', function (): void {
    expect($this->fieldMultiple)
        ->name()
        ->toBe('select_multiple[]')
        ->name('1')
        ->toBe('select_multiple[1]');
});
