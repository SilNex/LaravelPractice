<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'description' => implode($faker->paragraphs(5)),
        'password' => null,
    ];
});

$factory->state(App\Post::class, 'have_password', function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'description' => implode($faker->paragraphs(5)),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    ];
});
