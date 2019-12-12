<?php

namespace Tests\Feature;

use App\Comment;
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
            ->assertViewHas('comments', $this->post->comments()->simplePaginate(10));
    }

    public function testCreateComment(): void
    {
        $comment = factory('App\Comment')->make()->toArray();
        $lastPage = $this->post->comments()->paginate(10)->lastPage();
        $this->actingAs($this->user)->post("/posts/{$this->post->id}/comments", $comment)
            ->assertRedirect("/{$this->board->name}/posts/{$this->post->id}?page={$lastPage}");
        $this->assertDatabaseHas('comments', $comment);
    }

    public function testDeleteComment(): void
    {
        $this->actingAs($this->user)->delete("/posts/{$this->post->id}/comments/{$this->comment->id}")
            ->assertSuccessful();
        $this->assertDatabaseMissing('comments', $this->comment->toArray());
    }
}
