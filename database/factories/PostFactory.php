<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id, 
        'title' => $faker->sentence, 
        'body' => $faker->paragraph(2),
    ];
});
