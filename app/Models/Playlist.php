<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Playlist extends Model
{
	protected $table = 'playlists';

	protected $attributes = [
		'likes' => 0,
		'comments' => 0,
	];

	public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function songs()
    {
        return $this->belongsToMany('App\Models\Song', 'playlists_songs');
    }

    public function comments()
    {
       return $this->hasMany('App\Models\Comment');
    }

    public function likes()
    {
       return $this->hasMany('App\Models\Likes', 'likes');
    }
    // public function users()
    // {
    //     return $this->belongsToMany('App\Models\User', 'likes');
    // }
}
