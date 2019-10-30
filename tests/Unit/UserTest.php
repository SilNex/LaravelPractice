<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testCreateUser()
    {
        $user = factory('App\User')->create();
        $this->assertDatabaseHas('users', $user->toArray());
    }
}
