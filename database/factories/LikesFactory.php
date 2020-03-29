<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Likes;
use Faker\Generator as Faker;

$factory->define(Likes::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'playlist_id' => rand(1,15),
    ];
});
