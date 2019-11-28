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
        $permission = Permission::create(['name' => "{$this->board->name} writable"]);
        $this->user->givePermissionTo($permission);

        $this->posts = factory('App\Post')->create([
            'board_id' => $this->board->id,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function testGetPosts()
    {
        factory('App\Post', 5)->create([
            'board_id' => $this->board->id,
            'user_id' => $this->user->id,
        ]);

        $this->actingAs($this->user)->get("/{$this->board->name}/post")
            ->assertViewHas('posts', $this->board->posts);
    }

    /** @test */
    public function testForbiddenRequest()
    {
        $user = factory('App\User')->create();

        // Get post list forbidden
        $this->actingAs($user)->get('/post')
            ->assertForbidden();

        // Create post forbidden
        $post = [
            'name' => 'free',
            'display_name' => '자유게시판',
        ];
        $this->actingAs($user)->post('/post', $post)
            ->assertForbidden();

        // Update post forbidden
        $post = $this->post;
        $post['display_name'] = 'Foo';
        $this->actingAs($user)->put("/post/{$post->id}", $post->toArray())
            ->assertForbidden();

        $post = $this->post;
        $this->actingAs($user)->delete("/post/{$post->id}")
            ->assertForbidden();
    }
}
