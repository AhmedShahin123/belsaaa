<?php

namespace Tests\Feature\Backend;

use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class DashboardRouteTest.
 */
class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_cant_access_admin_dashboard()
    {
        $this->get('https://admin.belsaa.com/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function not_authorized_users_cant_access_admin_dashboard()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('https://admin.belsaa.com/dashboard');

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function admin_can_access_admin_dashboard()
    {
        $this->loginAsAdmin();

        $this->get('https://admin.belsaa.com/dashboard')->assertStatus(200);
    }
}
