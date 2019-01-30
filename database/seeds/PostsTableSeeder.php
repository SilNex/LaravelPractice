<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 30)->create([
            'user_id' => null,
        ])->each(function ($post) {
            $post->update([
                'user_id' => rand(1, 10),
            ]);
        });
    }
}
