<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    public function test_unauthenticated_user_is_redirected_from_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@coffeeshop.test'],
            ['name' => 'Admin Coffee Shop', 'password' => Hash::make('admin123'), 'role' => 'admin']
        );

        $response = $this->post('/admin/login', [
            'email' => 'admin@coffeeshop.test',
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_cannot_login_with_invalid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@coffeeshop.test',
            'password' => 'salah123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_logout(): void
    {
        $admin = User::first();
        $this->actingAs($admin);

        $response = $this->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
