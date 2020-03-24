<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Song;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'artist_id' => rand(1,5),
        'duration' => rand(2,4) . rand(0,50),
        'album_id' => null,
        'released_date' => rand(1950, 2020),
        'img' => $faker->imageUrl(480, 480),
        'url' => $faker->word(),
    ];
});
