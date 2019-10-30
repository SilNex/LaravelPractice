<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
    }

    public function testLogin(): void
    {
        $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ])->assertRedirect('/home');
    }

    public function testRegister(): void
    {
        $this->post('/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertRedirect('/home');
    }
}
