<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\playlist_song;
use Faker\Generator as Faker;

$factory->define(playlist_song::class, function (Faker $faker) {
    return [
        'playlist_id' => rand(1,15),
        'song_id' => rand(1,50),
    ];
});
