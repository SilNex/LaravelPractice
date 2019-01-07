<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'description' => implode($faker->paragraphs(5)),
        'password' => ((bool)rand(0, 1) ? 'secret' : null),
        'user_id' => 1, // post create Test user only 1
    ];
});
