<?php

namespace Tests\Feature;

use Tests\TestCase;

class InsightsSeoTest extends TestCase
{
    public function test_insights_index_page_is_successful(): void
    {
        $response = $this->get('/insights');
        $response->assertStatus(200);
        $response->assertSee('Insights', false);
        $response->assertSee('Field Notes', false);
    }

    public function test_robots_txt_is_accessible(): void
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);
        $response->assertSee('User-agent: *', false);
    }

    public function test_sitemap_xml_is_accessible(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertSee('https://famewoven.com', false);
    }
}

