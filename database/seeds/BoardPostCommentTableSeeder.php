<?php

use Illuminate\Database\Seeder;

class BoardPostCommentTableSeeder extends Seeder
{
    public function run()
    {
        $users = factory('App\User', 10)->create();
        $boards = factory('App\Board', 3)->create();
        $posts = collect([]);
        for ($i=0; $i < 20; $i++) {
            $posts[] = factory('App\Post')->create([
                'board_id' => $boards->random(),
                'user_id' => $users->random(),
            ]);
        }
        $comments = collect([]);
        for ($i=0; $i < 40; $i++) {
            $comments[] = factory('App\Comment')->create([
                'post_id' => $posts->random(),
                'user_id' => $users->random(),
            ]);
        }
    }
}
