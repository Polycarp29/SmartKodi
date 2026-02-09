<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        Mail::fake();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated(); // Laravel authenticates on registration? Wait, my controller helper does not login, it redirects to verify-otp.
        // Let's check my implementation. handleRegister does NOT login.

        // So I should NOT be authenticated yet.
        $this->assertGuest();

        $response->assertRedirect(route('auth.verify-otp', ['email' => 'test@example.com']));

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user->otp);
        $this->assertFalse((bool)$user->is_active);

        Mail::assertSent(OtpMail::class);
    }

    public function test_user_can_verify_otp()
    {
        $user = User::factory()->create([
            'otp' => '123456',
            'otp_expires_at' => Carbon::now()->addMinutes(10),
            'email_verified_at' => null,
            'is_active' => false,
        ]);

        $response = $this->post('/verify-otp', [
            'email' => $user->email,
            'otp' => '123456',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
        
        $user->refresh();
        $this->assertNull($user->otp);
        $this->assertNotNull($user->email_verified_at);
        $this->assertTrue((bool)$user->is_active);
    }

    public function test_user_cannot_verify_with_invalid_otp()
    {
        $user = User::factory()->create([
            'otp' => '123456',
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ]);

        $response = $this->post('/verify-otp', [
            'email' => $user->email,
            'otp' => '654321',
        ]);

        $response->assertSessionHasErrors('otp');
        $this->assertGuest();
    }

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_login_screen()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'is_active' => true,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_users_cannot_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_unverified_user_cannot_login_and_is_redirected_to_verify()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
            'email_verified_at' => null,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('auth.verify-otp', ['email' => $user->email]));
    }
}
