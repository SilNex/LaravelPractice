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

    /** @test */
    public function can_get_post_list_whitout_auth()
    {
        $posts = factory(Post::class, 10)->create();

        $response = $this->get('/posts');

        $this->assertTrue(Auth::guest());
        $response->assertSeeInOrder($posts->map(function ($post) {
            return $post->title;
        })->toArray());
    }

        /** @test */
        public function can_read_guest_post_that_has_not_password()
        {
            $post = factory(Post::class)->create([
                'password' => 'TestPassword',
            ]);
            $index = $post->id;
    
            $response = $this->get("/posts/{$index}");
    
            $this->assertGuest();
            $response->assertViewIs('posts.passCheck');
        }

    /** @test */
    public function cannot_read_guest_post_that_has_password_without_password()
    {
        $post = factory(Post::class)->create([
            'password' => 'TestPassword',
        ]);
        $index = $post->id;

        $response = $this->get("/posts/{$index}");

        $this->assertGuest();
        $response->assertViewIs('posts.passCheck');
    }

    /** @test */
    public function can_read_guest_post_that_has_password_with_password()
    {
        $post = factory(Post::class)->create([
            'password' => bcrypt('TestPassword'),
        ]);
        $response = $this->post("/posts/{$post->id}", ['password' => 'TestPassword']);

        $this->assertGuest();
        $response->assertRedirect("/posts/{$post->id}");
        $response->assertSessionHas("post_{$post->id}_password");
        $this->get("/posts/{$post->id}")->assertSee($post->description);
    }

    /** @test */
    public function cannot_access_edit_page_post_that_has_password_without_password()
    {
        $this->withExceptionHandling();
        
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'password' => bcrypt('TestPassword'),
        ]);

        $response = $this->actingAs($user)->get("/posts/{$post->id}/edit");
        $response->assertViewIs("posts.passCheck");
    }

    public function can_edit_post_that_has_not_password()
    {
        $this->withExceptionHandling();
        
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->post("/posts/{$post->id}/edit", [
            'title' => 'editTtile',
        ]);
        $response->assertRedirect("/posts/{$post->id}");
        $response->assertSee('editTtile');
    }
}