<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\CreatorApplication;
use App\Models\NewsletterSubscription;
use App\Models\StrategyCall;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $superAdmin;
    private User $admin;
    private User $editor;
    private User $viewer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = User::factory()->create([
            'name' => 'Root Super Admin',
            'email' => 'super@famewoven.com',
            'password' => Hash::make('Secret123!'),
            'role' => User::ROLE_SUPER_ADMIN,
            'status' => 'active',
        ]);

        $this->admin = User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@famewoven.com',
            'password' => Hash::make('Secret123!'),
            'role' => User::ROLE_ADMIN,
            'status' => 'active',
        ]);

        $this->editor = User::factory()->create([
            'name' => 'Operations Editor',
            'email' => 'editor@famewoven.com',
            'password' => Hash::make('Secret123!'),
            'role' => User::ROLE_EDITOR,
            'status' => 'active',
        ]);

        $this->viewer = User::factory()->create([
            'name' => 'Metrics Viewer',
            'email' => 'viewer@famewoven.com',
            'password' => Hash::make('Secret123!'),
            'role' => User::ROLE_VIEWER,
            'status' => 'active',
        ]);
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Command Center');
        $response->assertSee('System Admin');
    }

    public function test_strategy_calls_listing_and_filtering(): void
    {
        StrategyCall::create([
            'name' => 'Bruce Wayne',
            'email' => 'bruce@waynecorp.com',
            'phone' => '+15550199',
            'company_name' => 'Wayne Enterprises',
            'budget' => '$50,000+',
            'goal' => 'Enterprise brand lift',
            'details' => 'Scale global digital influence.',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->editor)->get(route('admin.strategy-calls.index'));

        $response->assertStatus(200);
        $response->assertSee('Bruce Wayne');
        $response->assertSee('Wayne Enterprises');
    }

    public function test_strategy_call_detail_and_status_update(): void
    {
        $call = StrategyCall::create([
            'name' => 'Diana Prince',
            'email' => 'diana@themyscira.gov',
            'phone' => '+15550188',
            'company_name' => 'Themyscira Global',
            'budget' => '$25k - $50k',
            'goal' => 'Cultural Awareness',
            'details' => 'Expanding ethical trade initiatives.',
            'status' => 'pending',
        ]);

        $detailResponse = $this->actingAs($this->editor)->get(route('admin.strategy-calls.show', $call));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Diana Prince');

        $updateResponse = $this->actingAs($this->editor)->patch(route('admin.strategy-calls.update', $call), [
            'status' => 'reviewed',
            'notes' => 'Scheduled initial discovery call for next Tuesday.',
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('strategy_calls', [
            'id' => $call->id,
            'status' => 'reviewed',
            'notes' => 'Scheduled initial discovery call for next Tuesday.',
        ]);
    }

    public function test_strategy_call_csv_export_allowed_for_admin_forbidden_for_viewer(): void
    {
        StrategyCall::create([
            'name' => 'Clark Kent',
            'email' => 'clark@dailyplanet.com',
            'phone' => '+15550177',
            'company_name' => 'Daily Planet',
            'budget' => '$10k - $25k',
            'goal' => 'Media Distribution',
            'details' => 'Metropolis news portal campaign.',
            'status' => 'pending',
        ]);

        // Admin gets CSV
        $adminResponse = $this->actingAs($this->admin)->get(route('admin.strategy-calls.export'));
        $adminResponse->assertStatus(200);
        $this->assertStringContainsString('text/csv', $adminResponse->headers->get('Content-Type') ?? '');

        // Viewer is forbidden (403)
        $viewerResponse = $this->actingAs($this->viewer)->get(route('admin.strategy-calls.export'));
        $viewerResponse->assertStatus(403);
    }

    public function test_creator_applications_listing_and_status_update(): void
    {
        $creator = CreatorApplication::create([
            'name' => 'Peter Parker',
            'email' => 'peter@spidey.nyc',
            'platform' => 'Instagram',
            'handle' => '@spidey_daily',
            'audience_size' => '250K',
            'niche' => 'Photography & Tech',
            'status' => 'pending',
        ]);

        $listResponse = $this->actingAs($this->admin)->get(route('admin.creators.index'));
        $listResponse->assertStatus(200);
        $listResponse->assertSee('Peter Parker');
        $listResponse->assertSee('@spidey_daily');

        $updateResponse = $this->actingAs($this->admin)->patch(route('admin.creators.update', $creator), [
            'status' => 'accepted',
            'notes' => 'Verified engagement rate at 6.8%. Onboarding packet dispatched.',
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('creator_applications', [
            'id' => $creator->id,
            'status' => 'accepted',
            'notes' => 'Verified engagement rate at 6.8%. Onboarding packet dispatched.',
        ]);
    }

    public function test_creator_applications_csv_export(): void
    {
        CreatorApplication::create([
            'name' => 'Tony Stark',
            'email' => 'tony@stark.io',
            'platform' => 'YouTube',
            'handle' => 'stark_tech',
            'audience_size' => '5M+',
            'niche' => 'Engineering',
            'status' => 'accepted',
        ]);

        $response = $this->actingAs($this->superAdmin)->get(route('admin.creators.export'));
        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type') ?? '');
    }

    public function test_subscribers_management_and_toggle(): void
    {
        $subscriber = NewsletterSubscription::create([
            'email' => 'subscriber@enterprise.com',
            'source' => 'footer',
            'status' => 'subscribed',
            'ip_address' => '127.0.0.1',
        ]);

        $listResponse = $this->actingAs($this->admin)->get(route('admin.subscribers.index'));
        $listResponse->assertStatus(200);
        $listResponse->assertSee('subscriber@enterprise.com');

        // Toggle to unsubscribed
        $toggleResponse = $this->actingAs($this->editor)->patch(route('admin.subscribers.toggle', $subscriber));
        $toggleResponse->assertRedirect();
        $this->assertDatabaseHas('newsletter_subscriptions', [
            'id' => $subscriber->id,
            'status' => 'unsubscribed',
        ]);

        // Admin can export subscribers
        $exportResponse = $this->actingAs($this->admin)->get(route('admin.subscribers.export'));
        $exportResponse->assertStatus(200);
        $this->assertStringContainsString('text/csv', $exportResponse->headers->get('Content-Type') ?? '');

        // Admin can delete subscriber
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.subscribers.destroy', $subscriber));
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('newsletter_subscriptions', [
            'id' => $subscriber->id,
        ]);
    }

    public function test_activity_logs_viewing_and_filtering(): void
    {
        ActivityLog::create([
            'user_id' => $this->admin->id,
            'event' => 'admin.test_action',
            'description' => 'Admin performed a test audit action',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit Browser',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.logs.activity'));
        $response->assertStatus(200);
        $response->assertSee('Activity Audit Trail');
        $response->assertSee('admin.test_action');
    }

    public function test_system_logs_accessible_to_admin_and_forbidden_to_viewer(): void
    {
        $adminResponse = $this->actingAs($this->admin)->get(route('admin.logs.system'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Laravel Log Stream');

        $viewerResponse = $this->actingAs($this->viewer)->get(route('admin.logs.system'));
        $viewerResponse->assertStatus(403);
    }

    public function test_user_management_restricted_to_admins(): void
    {
        // Editor gets 403
        $editorResponse = $this->actingAs($this->editor)->get(route('admin.users.index'));
        $editorResponse->assertStatus(403);

        // Viewer gets 403
        $viewerResponse = $this->actingAs($this->viewer)->get(route('admin.users.index'));
        $viewerResponse->assertStatus(403);

        // Super Admin gets 200
        $superResponse = $this->actingAs($this->superAdmin)->get(route('admin.users.index'));
        $superResponse->assertStatus(200);
        $superResponse->assertSee('Staff Governance & Roles');
    }

    public function test_super_admin_can_create_update_and_delete_staff_user(): void
    {
        // 1. Create staff user
        $storeResponse = $this->actingAs($this->superAdmin)->post(route('admin.users.store'), [
            'name' => 'Wade Wilson',
            'email' => 'deadpool@famewoven.com',
            'role' => 'editor',
            'password' => 'XForce2026!',
            'password_confirmation' => 'XForce2026!',
        ]);

        $storeResponse->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'deadpool@famewoven.com',
            'role' => 'editor',
        ]);

        $createdUser = User::where('email', 'deadpool@famewoven.com')->firstOrFail();

        // 2. Update role and status
        $updateResponse = $this->actingAs($this->superAdmin)->patch(route('admin.users.update', $createdUser), [
            'name' => 'Wade Wilson',
            'role' => 'admin',
            'status' => 'suspended',
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $createdUser->id,
            'role' => 'admin',
            'status' => 'suspended',
        ]);

        // 3. Delete user
        $deleteResponse = $this->actingAs($this->superAdmin)->delete(route('admin.users.destroy', $createdUser));
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('users', [
            'id' => $createdUser->id,
        ]);
    }

    public function test_admin_cannot_delete_their_own_account(): void
    {
        $response = $this->actingAs($this->superAdmin)->delete(route('admin.users.destroy', $this->superAdmin));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'You cannot delete your own administrative account.');
        $this->assertDatabaseHas('users', [
            'id' => $this->superAdmin->id,
        ]);
    }

    public function test_user_can_update_profile_and_password(): void
    {
        $profileResponse = $this->actingAs($this->editor)->patch(route('admin.profile.update'), [
            'name' => 'Updated Operations Lead',
            'email' => 'operations.lead@famewoven.com',
        ]);

        $profileResponse->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $this->editor->id,
            'name' => 'Updated Operations Lead',
            'email' => 'operations.lead@famewoven.com',
        ]);

        $passwordResponse = $this->actingAs($this->editor)->patch(route('admin.profile.password'), [
            'current_password' => 'Secret123!',
            'password' => 'BrandNewPass2026!',
            'password_confirmation' => 'BrandNewPass2026!',
        ]);

        $passwordResponse->assertRedirect();
        $this->editor->refresh();
        $this->assertTrue(Hash::check('BrandNewPass2026!', $this->editor->password));
    }
}
