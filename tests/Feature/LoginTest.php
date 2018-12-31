<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function user_can_view_a_login_form()
    {
        $reponse = $this->get('/login');

        $reponse->assertSuccessful();
        $reponse->assertViewIs('auth.login');
    }

    /** @test */
    public function user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(\App\User::class)->make();

        $response = $this->actingAs($user)->get('login');
        
        $response->assertRedirect('/home');
    }

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt($password = 'TestPassword'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAS($user);
    }

    /** @test */
    public function user_cannot_login_with_incorrect_password()
    {
        // $this->withoutExceptionHandling();
        
        $user = factory(\App\User::class)->create([
            'password' => bcrypt($password = 'TestPassword'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Incorrect-password'
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /** @test */
    public function remember_me_functionality()
    {
        $user = factory(\App\User::class)->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'TestPassword'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
