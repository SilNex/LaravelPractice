<?php

use Illuminate\Database\Seeder;

class BoardPostCommentTableSeeder extends Seeder
{
    public function run()
    {
        $users = factory('App\User', 10)->create();
        $users[] = factory('App\User')->state('silnex')->create();
        $boards = factory('App\Board', 3)->create();
        $posts = collect([]);
        for ($i=0; $i < 20; $i++) {
            $user = $users->random();
            $board = $boards->random();
            if ($user->canNot("{$board->name} use")) {
                $user->givePermissionTo("{$board->name} use");
            }
            $posts[] = factory('App\Post')->create([
                'board_id' => $board->id,
                'user_id' => $user->id,
            ]);
        }
        $comments = collect([]);
        for ($i=0; $i < 40; $i++) {
            $comments[] = factory('App\Comment')->create([
                'post_id' => $posts->random()->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
