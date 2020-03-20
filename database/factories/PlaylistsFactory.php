<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Playlist::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'description' => $faker->sentence( rand(3, 8) ),
        'img' => $faker->imageUrl(480, 480),
        'user_id' => rand(1,5),
    ];
});
