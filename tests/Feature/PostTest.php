<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class PostTest extends TestCase
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
    }

    /** @test */
    public function testGetPostsList()
    {
        factory('App\Post', 5)->create([
            'board_id' => $this->board->id,
            'user_id' => $this->user->id,
        ]);

        $this->actingAs($this->user)->get("{$this->board->name}/posts")
            ->assertViewHas('posts', $this->board->posts);
    }

    public function testCreatePost(): void
    {
        $post = factory('App\Post')->make()->toArray();
        $this->actingAs($this->user)->post("{$this->board->name}/posts", $post)
            ->assertRedirect("{$this->board->name}/posts");
        $this->assertDatabaseHas('posts', $post);
    }

    public function testDeletePost(): void
    {
        $this->actingAs($this->user)->delete("{$this->board->name}/posts/{$this->post->id}")
            ->assertSuccessful();
        $this->assertDeleted('posts', $this->post->toArray());
    }

    public function testCannotDeleteOtherUserPost(): void
    {
        $this->post->update([
            'user_id' => $this->user->id - 1,
        ]);
        $this->actingAs($this->user)->delete("{$this->board->name}/posts/{$this->post->id}")
            ->assertForbidden();
        $this->assertDatabaseHas('posts', $this->post->toArray());
    }

    /** @test */
    public function testForbiddenRequest()
    {
        $user = factory('App\User')->create();

        // Get post list forbidden
        $this->actingAs($user)->get("{$this->board->name}/posts")
            ->assertForbidden();

        // Create post forbidden
        $post = [
            'name' => 'free',
            'display_name' => '자유게시판',
        ];
        $this->actingAs($user)->post("{$this->board->name}/posts", $post)
            ->assertForbidden();

        // Update post forbidden
        $post = $this->post;
        $this->actingAs($user)->put("{$this->board->name}/posts/{$post->id}", $post->toArray())
            ->assertForbidden();

        // $post = $this->post;
        $this->actingAs($user)->delete("{$this->board->name}/posts/{$post->id}")
            ->assertForbidden();
    }
}
