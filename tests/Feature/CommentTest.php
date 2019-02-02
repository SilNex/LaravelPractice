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
        $this->otherUser = factory(User::class)->create();
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
    public function show_comment_on_the_post_have_password()
    {
        $comment = factory(comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
        $this->post->update([
            'password' => Hash::make('test'),
        ]);

        $this->actingAs($this->otherUser)
            ->get("/posts/{$this->post->id}/comments/$comment->id")
            ->assertForbidden();

        $this->actingAs($this->otherUser)
            ->get("/posts/{$this->post->id}/comments/$comment->id?password=test")
            ->assertOk();

        $this->actingAs($this->user)
            ->get("/posts/{$this->post->id}/comments/$comment->id")
            ->assertOk();
    }

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
        
        $this->post->update([
            'password' => Hash::make('test'),
        ]);

        $commentWithPassword = $comment + ['password' => 'wrongPassword'];
        $this->actingAs($this->otherUser)->post("/posts/{$this->post->id}/comments", $commentWithPassword)
            ->assertForbidden();
    }
    
    /** @test */
    public function update_comment_valid_user()
    {
        $comment = factory(comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        $description = [
            'description' => 'updateComment',
        ];

        $this->actingAs($this->user)
            ->put("/posts/{$this->post->id}/comments/{$comment->id}", $description)
            ->assertOk();
        $this->assertDatabaseHas('comments', ['description' => 'updateComment']);
    }

    /** @test */
    public function update_comment_invalid_user()
    {
        $comment = factory(comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        $description = [
            'description' => 'updateComment',
        ];

        $this->actingAs($this->otherUser)->put("/posts/{$this->post->id}/comments/{$comment->id}", $description)
            ->assertForbidden();
        $this->assertDatabaseMissing('comments', ['description' => 'updateComment']);
    }

    /** @test */
    public function delete_comment_valid_user()
    {
        $this->withoutExceptionHandling();

        $comment = factory(comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        $this->actingAs($this->user)->delete("/posts/{$this->post->id}/comments/{$comment->id}")
            ->assertOk();
        $this->assertDatabaseMissing('comments', $comment->toArray());
    }

    /** @test */
    public function delete_comment_invalid_user()
    {
        $comment = factory(comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        $this->actingAs($this->otherUser)->delete("/posts/{$this->post->id}/comments/{$comment->id}")
            ->assertForbidden();
        $this->assertDatabaseHas('comments', $comment->toArray());
    }
}
