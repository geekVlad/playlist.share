<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Playlist;
use App\Models\Likes;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Events\LikesRowDeleted;
use App\Events\FollowRowDeleted;

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

        //переписати це через моделі
        $playlists = DB::table('playlists')
            ->join('users', 'playlists.user_id', 'users.id')
            ->where('users.id', $userId)
            ->select('playlists.*')
            ->get();

        $top15 = DB::table('playlists')
            ->whereDate('updated_at', '>', Carbon::now()->subDays(7))
            ->select('playlists.*')
            ->limit(15)
            ->orderBy('likes_count', 'desc')
            ->get();

        $newPlaylists = DB::table('playlists')
            ->whereDate('updated_at', '>', Carbon::now()->subHours(23))
            ->select('playlists.*')
            ->limit(10)
            ->get();

        return view('home', ['playlists' => $playlists, 
                            'top15' => $top15,
                            'newPlaylists' => $newPlaylists,
                    ]);
    }

    public function AddPlaylistGet()
    {
        return view('addplaylist');
    }


    public function AddPlaylistPost(Request $request)
    {
        $valid = Validator::make($request->all(), [
          'title' => 'required|max:255',
            'description' => 'required|max:10',
            'playlistimage' => 'file|required|mimes:jpg,jpeg,gif',
        ]);

        if ($valid->fails()) {
          return redirect()
                    ->back()
                    ->withErrors($valid)
                    ->withInput();
        }

        if ($request->hasFile('playlistimage')) {
                $destinationPath = public_path('images/playlist/');
                $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->playlistimage->extension(); 
                $request->playlistimage->move($destinationPath, $fileName);
        }



    }

    public function myPlaylists()
    {
        $myPlaylists = User::getMyPlaylists();

        return view('myPlaylists', compact('myPlaylists'));
    }

    public function myFollows()
    {
        $myFollows = User::getMyFollows();

        return view('myFollows', compact('myFollows'));
    }

    public function playlistLiked(Request $request)
    {
        $playlistId = $request->id;
        $userId = Auth::id();

        $like = Likes::create(['user_id' => $userId, 'playlist_id' => $playlistId]);

        return redirect()->back();
    }

    public function playlistUnliked(Request $request)
    {
        $playlistId = $request->id;
        $userId = Auth::id();

        $like = Likes::where(['user_id' => $userId, 'playlist_id' => $playlistId])->first();

        event(new LikesRowDeleted($like));
        
        return redirect()->back();
    }

    public function playlistFollowed(Request $request)
    {
        $playlistId = $request->id;
        $userId = Auth::id();

        $follow = Follow::create(['user_id' => $userId, 'playlist_id' => $playlistId]);

        return redirect()->back();
    }

    public function playlistUnfollowed(Request $request)
    {
        $playlistId = $request->id;
        $userId = Auth::id();

        $follow = Follow::where(['user_id' => $userId, 'playlist_id' => $playlistId])->first();

        event(new FollowRowDeleted($follow));
        
        return redirect()->back();
    }
}
