<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
	protected $table = 'playlists';

	protected $attributes = [
		'likes' => 0,
		'comments' => 0,
	];
}
