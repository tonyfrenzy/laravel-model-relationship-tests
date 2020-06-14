<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Taggable;
use Faker\Generator as Faker;

$factory->define(Taggable::class, function (Faker $faker) {
    return [
        'tag_id' => App\Tag::all()->random()->id,
        'taggable_id' => $faker->boolean(50) 
                            ? App\Video::all()->random()->id 
                            : App\Post::all()->random()->id,
        'taggable_type' => 'App\Post'
    ];
});
