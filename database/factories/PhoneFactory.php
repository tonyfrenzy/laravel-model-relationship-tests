<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Phone;
use Faker\Generator as Faker;

$factory->define(Phone::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'number' => $faker->e164PhoneNumber
    ];
});
