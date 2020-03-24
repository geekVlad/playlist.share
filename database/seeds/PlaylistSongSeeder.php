<?php

use Illuminate\Database\Seeder;

class PlaylistSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\playlist_song::class, 30)->create();
    }
}
