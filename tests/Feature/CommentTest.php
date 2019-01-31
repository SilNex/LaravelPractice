<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Hash;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create([
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function add_comment_on_post()
    {
        $this->withoutExceptionHandling();

        $comment = factory(comment::class)->make([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
        // post request comment create
        $response = $this->actingAs($this->user)->post("/posts/{$this->post->id}/comments", $comment->toArray());

        // check db
        $this->assertDatabaseHas('comments', [
            'description' => $comment->description,
        ]);
    }

    /** @test */
    public function add_comment_on_the_post_have_password()
    {
        $comment = factory(comment::class)->make([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
        // update password in post
        $this->post->update([
            'password' => Hash::make('test'),
        ]);
        // add test without password
        $response = $this->actingAs($this->user)->post("/posts/{$this->post->id}/comments", $comment->toArray());
        // check false
        $response->assertForbidden();

        // add test with wrong password
        $commentWithPassword = $comment->toArray() + ['password' => 'wrongPassword'];
        $response = $this->actingAs($this->user)->post("/posts/{$this->post->id}/comments", $commentWithPassword);
        // check false
        $response->assertForbidden();

        // add test with password
        $commentWithPassword = $comment->toArray() + ['password' => 'test'];
        $response = $this->actingAs($this->user)->post("/posts/{$this->post->id}/comments", $commentWithPassword);
        // check true
        $response->assertStatus(201);
    }
}
