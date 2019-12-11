<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->board = factory('App\Board')->create();
        $permission = Permission::create(['name' => "{$this->board->name} use"]);
        $this->user->givePermissionTo($permission);

        $this->post = factory('App\Post')->create([
            'board_id' => $this->board->id,
            'user_id' => $this->user->id,
        ]);
        $this->comment = factory('App\Comment')->create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function testGetCommentList(): void
    {
        $this->actingAs($this->user)->get("/{$this->board->name}/posts/{$this->post->id}")
            ->assertViewHas('comments', $this->post->comments);
    }
}
