<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'nickname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute() 
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public static function getMyPlaylists()
    {
        $user = Auth::user();

        $myPlaylists = $user->playlists;

        return $myPlaylists;
    }

    public static function getMyFollows()
    {
        $user = Auth::user();

        $myFollows = $user->follows;

        return $myFollows;
    }

    public function playlists()
    {
       return $this->hasMany('App\Models\Playlist');
    }

    public function comments()
    {
       return $this->hasMany('App\Models\Comment');
    }

    public function follows()
    {
        return $this->belongsToMany('App\Models\Playlist', 'following_playlists');
    }

    // public function playlists()
    // {
    //    return $this->belongsTo('App\Models\Playlist', 'following_playlists');
    // }

    // public function playlists()
    // {
    //    return $this->belongsTo('App\Models\Playlist', 'likes');
    // }
}
