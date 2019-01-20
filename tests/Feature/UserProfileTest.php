<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    function read_user_info_page()
    {
        $user = $this->user;

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOK();
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /** @test */
    function update_user_profile()
    {
        $this->withoutExceptionHandling();

        $user = $this->user;
        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'newPassword',
        ];

        $this->actingAs($user)->put('/profile', $data);

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.com',
        ]);
        $this->assertDatabaseMissing('users', [
            'name' => 'Test'
        ]);

        $response = $this->post('/login', $data);
        
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
