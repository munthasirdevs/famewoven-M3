<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\VisitorTraffic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TrafficAndPrivacyTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $viewer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name' => 'Traffic Commander',
            'email' => 'traffic.admin@famewoven.com',
            'password' => Hash::make('Secret123!'),
            'role' => User::ROLE_ADMIN,
            'status' => 'active',
        ]);

        $this->viewer = User::factory()->create([
            'name' => 'Traffic Viewer',
            'email' => 'traffic.viewer@famewoven.com',
            'password' => Hash::make('Secret123!'),
            'role' => User::ROLE_VIEWER,
            'status' => 'active',
        ]);
    }

    public function test_public_visit_is_logged_in_visitor_traffic_with_cookie(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $this->assertDatabaseHas('visitor_traffic', [
            'path' => '/',
            'is_bot' => false,
        ]);

        $response->assertCookie('famewoven_vid');
    }

    public function test_admin_visit_is_not_logged_in_visitor_traffic(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);

        $this->assertDatabaseMissing('visitor_traffic', [
            'path' => '/admin/dashboard',
        ]);
    }

    public function test_static_asset_or_robot_route_is_not_logged(): void
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);

        $this->assertDatabaseMissing('visitor_traffic', [
            'path' => '/robots.txt',
        ]);
    }

    public function test_dnt_header_is_respected_and_skips_tracking(): void
    {
        $response = $this->withHeaders([
            'DNT' => '1',
        ])->get('/about');

        $response->assertStatus(200);

        $this->assertDatabaseMissing('visitor_traffic', [
            'path' => '/about',
        ]);
    }

    public function test_essential_only_cookie_preference_is_respected(): void
    {
        $response = $this->withCookies([
            'famewoven_cookie_consent' => 'essential',
        ])->get('/about');

        $response->assertStatus(200);

        $this->assertDatabaseMissing('visitor_traffic', [
            'path' => '/about',
        ]);
    }

    public function test_ip_address_is_strictly_anonymized_for_gdpr_compliance(): void
    {
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => '203.0.113.195',
        ])->get('/contact');

        $response->assertStatus(200);

        $this->assertDatabaseHas('visitor_traffic', [
            'path' => '/contact',
            'ip_address' => '203.0.113.xxx',
        ]);

        $this->assertDatabaseMissing('visitor_traffic', [
            'ip_address' => '203.0.113.195',
        ]);
    }

    public function test_traffic_overview_dashboard_renders_for_staff(): void
    {
        // Seed some sample traffic
        VisitorTraffic::create([
            'visitor_id' => 'fw_testvisitor123456789',
            'session_id' => 'sess_123',
            'path' => '/services/launch-campaigns',
            'url' => 'http://localhost/services/launch-campaigns',
            'ip_address' => '192.168.1.xxx',
            'device_type' => 'desktop',
            'browser' => 'Google Chrome',
            'os' => 'Windows 10/11',
            'referer_domain' => 'Google Search',
            'status_code' => 200,
            'is_bot' => false,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.traffic.index'));

        $response->assertStatus(200);
        $response->assertSee('Platform Traffic Intelligence');
        $response->assertSee('Total Pageviews');
        $response->assertSee('Unique Visitors');
        $response->assertSee('/services/launch-campaigns');
    }

    public function test_traffic_visitors_stream_table_and_filtering(): void
    {
        VisitorTraffic::create([
            'visitor_id' => 'fw_searchable_stream_token_999',
            'path' => '/work',
            'url' => 'http://localhost/work',
            'ip_address' => '10.0.0.xxx',
            'device_type' => 'mobile',
            'browser' => 'Apple Safari',
            'os' => 'iOS',
            'referer_domain' => 'X / Twitter',
            'status_code' => 200,
            'is_bot' => false,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.traffic.visitors', [
            'search' => 'searchable_stream',
        ]));

        $response->assertStatus(200);
        $response->assertSee('Visitor Request Dossiers');
        $response->assertSee('/work');
        $response->assertSee('X / Twitter');
    }

    public function test_traffic_csv_export_allowed_for_admin_and_forbidden_for_viewer(): void
    {
        VisitorTraffic::create([
            'visitor_id' => 'fw_export_test_token',
            'path' => '/insights',
            'url' => 'http://localhost/insights',
            'ip_address' => '172.16.0.xxx',
            'device_type' => 'desktop',
            'browser' => 'Mozilla Firefox',
            'os' => 'Linux',
            'status_code' => 200,
            'is_bot' => false,
        ]);

        // Admin gets CSV
        $adminResponse = $this->actingAs($this->admin)->get(route('admin.traffic.export'));
        $adminResponse->assertStatus(200);
        $this->assertStringContainsString('text/csv', $adminResponse->headers->get('Content-Type') ?? '');

        // Viewer is forbidden (403)
        $viewerResponse = $this->actingAs($this->viewer)->get(route('admin.traffic.export'));
        $viewerResponse->assertStatus(403);
    }

    public function test_public_pages_render_footer_cookie_button_and_transparency_modal(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Check footer button
        $response->assertSee('Cookie Preferences');

        // Check transparency modal content
        $response->assertSee('What We Strictly NEVER Collect (Zero Illegal Tracking)', false);
        $response->assertSee('Strictly Necessary Cookies', false);
        $response->assertSee('Anonymized Analytics Telemetry', false);
    }
}

