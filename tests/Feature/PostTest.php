<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\User;

class PostTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function can_create_post_without_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make([
            'password' => null,
        ]);

        $index = 1;
        $response = $this->actingAs($user)->post('/posts', $post->toArray());
        $response->assertRedirect("/posts/{$index}");

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'description' => $post->description,
        ]);
    }

    /** @test */
    public function can_post_create_with_password()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make([
            'password' => 'my_test_password',
        ]);

        $index = 1;
        $response = $this->actingAs($user)->post('/posts', $post->makeVisible('password')->toArray());
        $response->assertRedirect("/posts/{$index}");

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'description' => $post->description
        ]);

        $this->assertTrue(password_verify('my_test_password', Post::find($index)->password));
    }

    /** @Test */
    public function can_get_post_list_whitout_auth()
    {
        $posts = factory(Post::class, 10)->create();

        $response = $this->get('/posts');

        $response->assertTrue(Auth::guest());
        $response->assertSeeInOrder($posts->map(function ($post) {
            return $post->title;
        })->toArray());
    }
}
