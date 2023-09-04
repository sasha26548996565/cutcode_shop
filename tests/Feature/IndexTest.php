<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this->get(route('index'));
        $response->assertOk();
        $response->assertViewIs('index');
        $response->assertViewHasAll(['products', 'brands', 'categories']);
    }
}
