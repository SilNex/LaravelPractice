<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        $user = factory('App\User')->create();
        Auth::login($user);
        $this->user = auth();
        $this->board = factory('App\Board')->create();
    }

    public function testCreateBoard(): void
    {
        $this->actingAs($this->user)->post(route('board.create', [], false), [
            'name' => 'free',
            'display_name' => '자유게시판',
        ])->assertCreated()
            ->assertRedirect('/board/free');
    }

    public function testToLongBoardName(): void
    {
        $this->followingRedirects()
            ->actingAs($this->user)
            ->post(route('board.create', [], false), [
                'name' => str_repeat('A',256),
                'display_name' => 'A',
            ])->assertSessionHasErrors(['name']);
    }
}
