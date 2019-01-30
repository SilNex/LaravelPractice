<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 30)->create([
            'user_id' => null,
            'post_id' => null,
        ])->each(function ($comment) {
            $comment->update([
                'user_id' => rand(1, 10),
                'post_id' => rand(1, 20),
            ]);
        });
    }
}
