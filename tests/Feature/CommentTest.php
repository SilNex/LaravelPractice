<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;
use App\Commnet;
use Illuminate\Support\Facades\DB;

class CommentTest extends TestCase
{
    /** @test */
    public function append_commnet()
    {
        /**
         * To Do
         * get insert {post} parameter :? insert_id?
         */
        // create user
        $user = User::create();
        // create fake data of post and commnet
        $commnet = factory(Commnet::class)->make();
        $post = factory(Post::class)->make();
        // post create with auth
        $this->actingAs($user)->post('/posts', $post->toArray());
        // store post commnent
        $postId = DB::getPdo()->lastInsertId();
        $response = $this->actingAs($user)->post("/{$postId}/comments", $commnet->toArray());

        // check return 200
        $response->assertRedirect("/posts/{$postId}");
        // chcek db
        $this->assertDatabaseHas('commnets', $commnet->toArray());
    }
}
