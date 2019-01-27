<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            $posts = factory(App\Post::class, 10)->make([
                'password' => ((bool)rand(0, 1) ? Hash::make('secret') : null)
            ]);
            foreach ($posts as $post) {
                $user->posts()->save($post);
            }
        });
    }
}
