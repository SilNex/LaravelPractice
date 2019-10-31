<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testCreateUser(): void
    {
        $user = factory('App\User')->create();
        Auth::login($user);
        $this->assertTrue(Auth::check());
    }
}
