<?php

namespace Tests\Feature;

use Tests\TestCase;

class CorePagesTest extends TestCase
{
    public function test_home_page_is_successful(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Famewoven', false);
        $response->assertSee('Where Influence Is Woven', false);
    }

    public function test_about_page_is_successful(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('infrastructure behind influence', false);
        $response->assertSee('Munthasir Rahman', false);
    }

    public function test_404_page_is_rendered_for_unknown_routes(): void
    {
        $response = $this->get('/this-route-does-not-exist');
        $response->assertStatus(404);
        $response->assertSee("This page didn't get woven in", false);
    }
}
