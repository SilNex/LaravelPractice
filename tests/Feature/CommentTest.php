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
    public function show_comment_on_post()
    {
        $comment = factory(comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
        // show each comment
        $this->actingAs($this->user)
            ->get("/posts/{$this->post->id}/comments/{$comment->id}")
            ->assertSee($comment->description);
    }

    /** @test */
    // public function show_comment_on_the_post_have_password()
    // {
    //     $comment = factory(comment::class)->create([
    //         'user_id' => $this->user->id,
    //         'post_id' => $this->post->id,
    //     ]);
    //     // update password in post
    //     $this->post->update([
    //         'password' => Hash::make('test'),
    //     ]);
    // }

    /** @test */
    public function add_comment_valid_password()
    {
        $comment = factory(comment::class)->make([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ])->toArray();
        
        $this->post->update([
            'password' => Hash::make('test'),
        ]);
        $this->actingAs($this->user)
            ->post("/posts/{$this->post->id}/comments", $comment)
            ->assertStatus(201);

        $commentWithPassword = $comment + ['password' => 'test'];
        $this->actingAs($this->user)
            ->post("/posts/{$this->post->id}/comments", $commentWithPassword)
            ->assertStatus(201);
    }

    /** @test */
    public function add_comment_invalid_password()
    {
        $comment = factory(comment::class)->make([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ])->toArray();
        $otherUser = factory(User::class)->create();
        
        $this->post->update([
            'password' => Hash::make('test'),
        ]);

        $commentWithPassword = $comment + ['password' => 'wrongPassword'];
        $this->actingAs($otherUser)->post("/posts/{$this->post->id}/comments", $commentWithPassword)
            ->assertForbidden();
    }
}
