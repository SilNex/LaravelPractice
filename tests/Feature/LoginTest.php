<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
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
}
