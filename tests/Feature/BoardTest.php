<?php

namespace Tests\Feature;

use App\Board;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $role = Role::create(['name' => 'Board Manager']);
        $this->user->assignRole($role);
        $this->board = factory('App\Board')->create();
    }

    public function testGetBoardsList(): void
    {
        factory('App\Board', 5)->create();

        $this->actingAs($this->user)->get('/boards')
            ->assertViewHas('boards', Board::all());
    }

    public function testCreateBoard(): void
    {
        $board = [
            'name' => 'free',
            'display_name' => '자유게시판',
        ];
        $this->actingAs($this->user)->post('/boards', $board)
            ->assertRedirect('/boards');
        $this->assertDatabaseHas('boards', $board);
    }

    public function testReadBoard(): void
    {
        $board = $this->board;

        $this->actingAs($this->user)->get("/boards/{$board->name}")
            ->assertViewHasAll($board->toArray());
    }

    public function testUpdateBoard(): void
    {
        $board = $this->board;
        $board['display_name'] = 'Foo';

        $this->actingAs($this->user)->put("/boards/{$board->name}", $board->toArray())
            ->assertRedirect("/boards/{$board->name}");
        $this->assertDatabaseHas('boards', $board->toArray());
    }

    public function testCanNotUpdateBoardName(): void
    {
        $board = $this->board;
        $boardArray = $this->board->toArray();
        $boardArray['name'] = 'Foo';
        $this->actingAs($this->user)->put("/boards/{$board->name}", $boardArray)
            ->assertRedirect("/boards/{$board->name}/edit");
        $this->assertDatabaseHas('boards', $board->toArray());
    }

    public function testToLongBoardName(): void
    {
        $this->actingAs($this->user)->post('/boards', [
            'name' => str_repeat('A', 256)
        ])->assertSessionHasErrors(['name']);
    }

    public function testDeleteBoard(): void
    {
        $board = $this->board;
        $this->actingAs($this->user)->delete("/boards/{$board->name}")
            ->assertSuccessful();
        $this->assertDatabaseMissing('boards', $board->toArray());
    }

    /** @test */
    public function testForbiddenRequest()
    {
        $user = factory('App\User')->create();

        // Get board list forbidden
        $this->actingAs($user)->get('/boards')
            ->assertForbidden();

        // Create board forbidden
        $board = [
            'name' => 'free',
            'display_name' => '자유게시판',
        ];
        $this->actingAs($user)->post('/boards', $board)
            ->assertForbidden();

        // Update board forbidden
        $board = $this->board;
        $board['display_name'] = 'Foo';
        $this->actingAs($user)->put("/boards/{$board->name}", $board->toArray())
            ->assertForbidden();

        $board = $this->board;
        $this->actingAs($user)->delete("/boards/{$board->name}")
            ->assertForbidden();
    }
}
