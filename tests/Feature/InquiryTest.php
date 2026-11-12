<?php

namespace Tests\Feature;

use App\Models\StrategyCall;
use App\Models\CreatorApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_renders_successfully(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Tell us what you want to move', false);
    }

    public function test_strategy_call_submission_validates_required_fields(): void
    {
        $response = $this->postJson('/contact', []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'company_name', 'email', 'phone', 'goal', 'budget', 'details']);
    }

    public function test_strategy_call_submission_saves_to_database(): void
    {
        $payload = [
            'name' => 'Safwan Ahmed',
            'company_name' => 'Aura Goods Ltd',
            'email' => 'safwan@auragoods.com',
            'phone' => '+880 1700 000000',
            'goal' => 'ecommerce-sales',
            'budget' => '150k-350k',
            'details' => 'Scaling our luxury apparel brand across high-reach fashion creators on X.',
        ];

        $response = $this->postJson('/contact', $payload);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Brief Received.',
        ]);

        $this->assertDatabaseHas('strategy_calls', [
            'email' => 'safwan@auragoods.com',
            'company_name' => 'Aura Goods Ltd',
        ]);
    }

    public function test_creators_page_renders_successfully(): void
    {
        $response = $this->get('/creators');
        $response->assertStatus(200);
        $response->assertSee('Vetted Network Architecture', false);
        $response->assertSee('Join the creator network', false);
    }

    public function test_creator_application_submission_validates_required_fields(): void
    {
        $response = $this->postJson('/creators', []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'platform', 'handle', 'niche', 'audience_size', 'email']);
    }

    public function test_creator_application_submission_saves_to_database(): void
    {
        $payload = [
            'name' => 'Nabila Tech',
            'platform' => 'youtube',
            'handle' => '@nabilatech',
            'niche' => 'tech',
            'audience_size' => '75k-250k',
            'email' => 'nabila@creators.com',
        ];

        $response = $this->postJson('/creators', $payload);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Application Received.',
        ]);

        $this->assertDatabaseHas('creator_applications', [
            'email' => 'nabila@creators.com',
            'handle' => '@nabilatech',
        ]);
    }
}
