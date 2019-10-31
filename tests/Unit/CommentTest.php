<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->board = factory('App\Board')->create();
        $this->post = factory('App\Post')->create([
            'board_id' => $this->board->id,
            'user_id' => $this->user->id,
        ]);
        $this->comments = factory('App\Comment', 2)->create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function testCreateComment(): void
    {
        $comment = factory('App\Comment')->create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);

        $this->assertDatabaseHas('comments', $comment->toArray());
    }

    public function testGetPostComment()
    {
        $comments = $this->comments;

        foreach ($comments as $comment) {
            $this->assertTrue($this->post->comments->contains($comment));
        }
    }

    public function testGetUserComment()
    {
        $comments = $this->comments;

        foreach ($comments as $comment) {
            $this->assertTrue($this->user->comments->contains($comment));
        }
    }
}
