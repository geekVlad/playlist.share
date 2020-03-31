<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Playlist extends Model
{
    use Searchable;


	protected $table = 'playlists';

	protected $attributes = [
		'likes' => 0,
		'comments' => 0,
	];


    public function searchPlaylist($playlistName)
    {
        return $this->('title', $playlistName);
    }


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

    public function followers()
    {
       return $this->hasMany('App\Models\User', 'following_playlists');
    }
    // public function users()
    // {
    //     return $this->belongsToMany('App\Models\User', 'likes');
    // }
}
