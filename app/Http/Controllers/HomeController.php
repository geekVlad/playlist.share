<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Playlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        //$user = Auth::user();

        $playlists = DB::table('playlists')
            ->join('users', 'playlists.user_id', '=', 'users.id')
            ->where('users.id', '=', $userId)
            ->select('playlists.*')
            ->get();
        // $playlists = DB::table('playlists')->->get()

        return view('home', ['playlists' => $playlists] );
    }
}
