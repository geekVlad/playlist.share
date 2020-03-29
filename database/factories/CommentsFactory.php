<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'playlist_id' => rand(1,15),
        'message' => $faker->sentence( rand(3, 8) ),
    ];
});
