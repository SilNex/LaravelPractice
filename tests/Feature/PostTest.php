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
    function create_post_with_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make([
            'password' => 'MyTestPassword',
        ]);
        
        $response = $this->actingAs($user)->post('/posts', $post->makeVisible('password')->toArray());

        $response->assertRedirect('/posts/1');
        $this->get('/posts/1')->assertViewIs('posts.passCheck');
    }

    /** @test */
    function read_post_without_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make();

        $this->actingAs($user)->post('/posts', $post->toArray());
        $response = $this->get('/posts/1');

        $response->assertSee($post->title);
        $response->assertSee($post->description);
    }

    /** @test */
    function read_post_with_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make([
            'password' => 'MyTestPassword',
        ]);
        
        $this->actingAs($user)->post('/posts', $post->makeVisible('password')->toArray());
        $response = $this->post('/posts/1',[
            'password' => 'MyTestPassword',
        ]);

        $response->assertRedirect('/posts/1');
        $response->assertSessionHas('post_1_password');
    }

    /** @test */
    function update_post_without_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make();
        $data = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ];

        $this->actingAs($user)->post('/posts', $post->toArray());
        
        $this->actingAs($user)->put('/posts/1', $data);

        $this->assertDatabaseHas('posts', $data);
    }

    /** @test */
    function delete_post_without_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make();
        
        $this->actingAs($user)->post('/posts', $post->toArray());

        $this->actingAs($user)->delete('/posts/1');

        $this->assertDatabaseMissing('posts', $post->toArray());
    }
}