<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Playlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        $playlists = DB::table('playlists')
            ->join('users', 'playlists.user_id', 'users.id')
            ->where('users.id', $userId)
            ->select('playlists.*')
            ->get();

        $top15 = DB::table('playlists')
            ->whereDate('updated_at', '>', Carbon::now()->subDays(7))
            ->select('playlists.*')
            ->limit(15)
            ->orderBy('likes', 'desc')
            ->get();

        return view('home', ['playlists' => $playlists, 'top15' => $top15] );
    }
}
