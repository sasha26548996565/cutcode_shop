<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Option;
use App\Models\Product;
use App\Models\Category;
use App\Models\Property;
use MoonShine\MoonShine;
use App\Models\OptionValue;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup;
use App\Models\ProductProperty;
use Illuminate\Support\ServiceProvider;
use App\MoonShine\Resources\BrandResource;
use App\MoonShine\Resources\OptionResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\PropertyResource;
use MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\OptionValueResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\PropertyProductsResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable(),

            MenuItem::make('Products', new ProductResource())
                ->badge(fn () => Product::count())
                ->icon('heroicons.briefcase'),

            MenuItem::make('Brands', new BrandResource())
                ->badge(fn () => Brand::count())
                ->icon('heroicons.briefcase'),

            MenuItem::make('Categories', new CategoryResource())
                ->badge(fn () => Category::count())
                ->icon('heroicons.briefcase'),

            MenuItem::make('Option', new OptionResource())
                ->badge(fn () => Option::count())
                ->icon('heroicons.briefcase'),

            MenuItem::make('Option Value', new OptionValueResource())
                ->badge(fn () => OptionValue::count())
                ->icon('heroicons.briefcase'),

            MenuItem::make('Property', new PropertyResource())
                ->badge(fn () => Property::count())
                ->icon('heroicons.briefcase'),

            MenuItem::make('Property Values', new PropertyProductsResource())
                ->badge(fn () => ProductProperty::count())
                ->icon('heroicons.briefcase'),
        ]);
    }
}
