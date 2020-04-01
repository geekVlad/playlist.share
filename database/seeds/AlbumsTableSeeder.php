<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albums')->insert([
            'title' => 'single',
            'artist_id' => null,
            'img' => null,
            'released_date' => null,
        ]);
    }
}
