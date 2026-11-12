<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesWorkTest extends TestCase
{
    public function test_work_index_page_is_successful(): void
    {
        $response = $this->get('/work');
        $response->assertStatus(200);
        $response->assertSee('Work', false);
    }

    public function test_work_case_study_page_is_successful(): void
    {
        $response = $this->get('/work/case-study');
        $response->assertStatus(200);
        $response->assertSee('Case Study', false);
    }

    public function test_services_index_page_is_successful(): void
    {
        $response = $this->get('/services');
        $response->assertStatus(200);
        $response->assertSee('Services', false);
    }

    public function test_all_14_service_pages_are_successful(): void
    {
        $services = [
            'creator-seeding',
            'custom-x-campaigns',
            'founder-ceo-campaigns',
            'influencer-outreach',
            'launch-campaigns',
            'long-term-creator-partnerships',
            'multi-creator-campaigns',
            'organic-amplification',
            'performance-campaigns',
            'product-promotion',
            'quote-reposts',
            'sponsored-x-posts',
            'trend-narrative-campaigns',
            'x-threads',
        ];

        foreach ($services as $service) {
            $response = $this->get('/services/' . $service);
            $response->assertStatus(200);
        }
    }
}
