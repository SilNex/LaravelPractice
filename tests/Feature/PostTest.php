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
    public function create_post_with_auth()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $post = factory(Post::class)->make();

        $response = $this->actingAs($user)->post('/posts', $post->toArray());
        
        $response->assertRedirect('/posts');
        $response->assertSee($post->title);

    }
    
}
