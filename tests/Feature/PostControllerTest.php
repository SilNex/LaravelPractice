<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_access_post_index_page_without_auth()
    {
        $user = factory(\App\User::class)->create();
        
        $response = $this->post('/posts');

        $response->assertStatus(200);
    }
}
