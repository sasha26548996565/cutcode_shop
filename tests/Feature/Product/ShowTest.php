<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Models\Product;
use Database\Seeders\BrandSeeder;
use Database\Seeders\OptionSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PropertySeeder;
use Database\Seeders\OptionValueSeeder;

class ShowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(BrandSeeder::class);    
        $this->seed(PropertySeeder::class);    
        $this->seed(OptionSeeder::class);    
        $this->seed(OptionValueSeeder::class);    
        $this->seed(CategorySeeder::class);    
    }

    public function test_show_product(): void
    {
        $product = Product::first();
        
        $response = $this->get(route('product.show', $product));
        $response->assertOk();

        $response->assertViewIs('product.show');
        $response->assertViewHas('product');

        $response->assertSee($product->title);
        $response->assertSee($product->slug);
        $response->assertSee($product->price);
        $response->assertSee($product->description);
    }
}
