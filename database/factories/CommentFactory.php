<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id, 
        'post_id' => App\Post::all()->random()->id, 
        'body' => $faker->paragraph(2),
    ];
});
