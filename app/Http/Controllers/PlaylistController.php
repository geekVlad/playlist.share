<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\Likes;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'playlistimage' => 'file|required|mimes:jpg,jpeg,png',
        ]);

    if ($valid->fails()) {
      return redirect()
                ->back()
                ->withErrors($valid)
                ->withInput();
        }

        $destinationPath = public_path('images/playlist/');
        $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->playlistimage->extension(); 
        $request->playlistimage->move($destinationPath, $fileName);

        $playlist = new Playlist;

        $playlist->title = $request->title;
        $playlist->description = $request->description;
        $playlist->img = $fileName;
        $playlist->user_id = Auth::user()->id;

        $playlist->save();

        return redirect('playlist?id=' . $playlist->id );

    }

    public function ShowPlaylist(Request $request)
    {
        $userId = Auth::id();

        $like = Likes::where(['user_id' => $userId, 'playlist_id' => $request->id])->first();

        $playlist = Playlist::where('id', $request->id)->first();

        $comments = Comment::with('user')->where('playlist_id', $playlist->id)->orderBy('updated_at')->get();

        if(!$playlist){
            return "Такого плейлиста немає";
        }

        if(Auth::user()->id == $playlist->user_id){
            return view('myplaylist', ['playlist' => $playlist, 'like' => $like, 'comments' => $comments ]);
        }

        return view('playlist', ['playlist' => $playlist, 'like' => $like, 'comments' => $comments
                    ]);
    }

    public function addComment(Request $request)
    {
        $message = $request->input('message');
        $userId = Auth::id();
        $playlistId = $request->id;

        $comment = Comment::create(['user_id' => $userId, 
            'playlist_id' => $playlistId, 
            'message' => $message,
        ]);
        return redirect()->back();
    }
    
}
