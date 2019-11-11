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
            ->assertViewHasAll($board->toArray());
    }

    public function testUpdateBoard(): void
    {
        $board = $this->board;
        $board['display_name'] = 'Foo';

        $this->put("/board/{$board->id}", $board->toArray())
            ->assertRedirect("/board/{$board->id}");
        $this->assertDatabaseHas('boards', $board->toArray());
    }

    public function testCanNotUpdateBoardName(): void
    {
        $board = $this->board;
        $boardArray = $this->board->toArray();
        $boardArray['name'] = 'Foo';
        $this->put("/board/{$board->id}", $boardArray)
            ->assertRedirect("/board/{$board->id}/edit");
        $this->assertDatabaseHas('boards', $board->toArray());
    }

    public function testToLongBoardName(): void
    {
        $this->post('/board', [
            'name' => str_repeat('A', 256)
        ])->assertSessionHasErrors(['name']);
    }

    public function testDeleteBoard(): void
    {
        $board = $this->board;
        $this->delete("/board/{$board->id}")
            ->assertRedirect('/board');
        $this->assertDatabaseMissing('boards', $board->toArray());
    }
}
