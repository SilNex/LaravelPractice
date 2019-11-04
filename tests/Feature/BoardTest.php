<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->board = factory('App\Board')->create();
    }

    public function testCreateBoard(): void
    {
        $this->actingAs($this->user)->post('/board', [
            'name' => 'free',
            'display_name' => '자유게시판',
        ])->assertCreated()->assertRedirect('/board/free');
    }

    public function testToLongBoardName(): void
    {
        $this->post('/board', [
                'name' => str_repeat('A',256)
            ])->assertSessionHasErrors(['name']);
    }
}
