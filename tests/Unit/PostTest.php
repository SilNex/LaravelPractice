<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->board = factory('App\Board')->create();
    }

    public function testCreatePost(): void
    {
        $post = factory('App\Post')->create([
            'board_id' => $this->board->id,
            'writer_id' => $this->user->id,
        ]);

        $this->assertDatabaseHas('posts', $post->toArray());
    }
}
