<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {

    return [
        'title' => $faker->sentence(5),
        'description' => implode($faker->paragraphs(5)),
        'password' => null,
    ];
});
