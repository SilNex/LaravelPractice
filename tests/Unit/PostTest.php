<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->board = factory('App\Board')->create();

        $this->posts = factory('App\Post', 2)->create([
            'board_id' => $this->board->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function testCreatePost(): void
    {
        $post = factory('App\Post')->create([
            'board_id' => $this->board->id,
            'user_id' => $this->user->id,
        ]);

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function testGetUserPost(): void
    {
        $posts = $this->posts;

        foreach ($posts as $post) {
            $this->assertTrue($this->user->posts->contains($post));
        }
    }

    public function testGetBoardPost()
    {
        $posts = $this->posts;

        foreach ($posts as $post) {
            $this->assertTrue($this->board->posts->contains($post));
        }
    }
}
