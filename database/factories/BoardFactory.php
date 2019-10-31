<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Board;
use Faker\Generator as Faker;

$factory->define(Board::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'explain' => implode(PHP_EOL, $faker->sentences(3)),
    ];
});
