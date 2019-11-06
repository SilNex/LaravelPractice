<?php

namespace Tests\Feature;

use App\Board;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->user = factory('App\User')->create();
        $this->board = factory('App\Board')->create();
    }

    public function testGetBoards(): void
    {
        factory('App\Board', 5)->create();

        $this->get('/board')
            ->assertViewHas('boards', Board::all());
    }

    public function testCreateBoard(): void
    {
        $board = [
            'name' => 'free',
            'display_name' => '자유게시판',
        ];
        $this->post('/board', $board)
            ->assertRedirect('/board');
        $this->assertDatabaseHas('boards', $board);
    }

    public function testReadBoard(): void
    {
        $board = $this->board;

        $this->get("/board/{$board->id}")
            ->assertViewHas('board', $board);
    }

    public function testToLongBoardName(): void
    {
        $this->post('/board', [
                'name' => str_repeat('A',256)
            ])->assertSessionHasErrors(['name']);
    }
}
