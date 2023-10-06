<?php

use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\File;
use MoonShine\Fields\Image;

uses()->group('fields');
uses()->group('file-field');

beforeEach(function (): void {
    $this->field = Image::make('Image')
        ->disk('public')
        ->dir('images');

    $this->fieldMultiple = Image::make('Images')
        ->multiple()
        ->disk('public')
        ->dir('images');

    $this->item = new class () extends Model {
        public string $image = 'images/image.png';
        public string $images = '["images/image1.png", "images/image2.png"]';

        protected $casts = ['images' => 'collection'];
    };
});


it('file is parent', function (): void {
    expect($this->field)
        ->toBeInstanceOf(File::class);
});

it('type', function (): void {
    expect($this->field->type())
        ->toBe('file');
});

it('view', function (): void {
    expect($this->field->getView())
        ->toBe('moonshine::fields.image');
});

it('index view value', function (): void {
    expect($this->field->indexViewValue($this->item))
        ->toBe(
            view('moonshine::ui.image', [
                'value' => $this->field->pathWithDir($this->item->image),
            ])->render()
        );
});

it('index view value for multiple', function (): void {
    $files = collect($this->item->images)
        ->map(fn ($value) => $this->fieldMultiple->pathWithDir($value))
        ->toArray();

    expect($this->fieldMultiple->indexViewValue($this->item))
        ->toBe(
            view('moonshine::ui.image', [
                'values' => $files,
            ])->render()
        );
});

it('empty index view value', function (): void {
    $this->item->image = '';

    expect($this->field->indexViewValue($this->item))
        ->toBeEmpty();
});

it('empty index view value for multiple', function (): void {
    $this->item->images = '';

    expect($this->fieldMultiple->indexViewValue($this->item))
        ->toBeEmpty();
});
