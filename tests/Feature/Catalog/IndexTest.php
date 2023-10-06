<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_catalog_index(): void
    {
        $response = $this->get(route('catalog.index'));
        $response->assertOk();
        $response->assertViewIs('catalog.index');
        $response->assertViewHasAll(['products', 'brands', 'categories']);
    }
}
