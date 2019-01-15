<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;
use App\User;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function create_post_without_password()
    {

        $user = factory(User::class)->create();
        $post = factory(Post::class)->make();
        
        $response = $this->actingAs($user)->post('/posts', $post->toArray());

        $response->assertRedirect('/posts/1');
        $this->assertDatabaseHas('posts', ['title' => $post->title, 'description' => $post->description]);
    }

    /** @test */
    function read_post_without_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make();

        $response = $this->actingAs($user)->post('/posts', $post->toArray());
        $response = $this->get('/posts/1');

        $response->assertSee($post->title);
        $response->assertSee($post->description);
    }
}