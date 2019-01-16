<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserInfoTest extends TestCase
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
}
