<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        "url" => $faker->url,
        "imageable_id" => App\Post::all()->random()->id,
        "imageable_type" => App\Post::all()->random()->title,
    ];
});
