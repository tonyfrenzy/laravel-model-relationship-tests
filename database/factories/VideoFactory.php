<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'title' => $faker->word,
        'description' => $faker->sentence,
        'size' => $faker->numberBetween(100,2000),
        'length' => $faker->numberBetween(30,3000),
    ];
});
