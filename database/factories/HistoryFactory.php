<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\History;
use Faker\Generator as Faker;

$factory->define(History::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id, 
        'details' => $faker->sentence,
    ];
});
