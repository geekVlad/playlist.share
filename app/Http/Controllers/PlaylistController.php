<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\Likes;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Album;
use App\Models\Artist;
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

        $playlist = Playlist::with(['songs.artist', 'songs.album', 'user'])->where('id', $request->id)->first();

        $comments = Comment::with('user')->with('childrens')->where('playlist_id', $playlist->id)->orderBy('updated_at', 'Desc')->get();

        $follow = Follow::where(['user_id' => $userId, 'playlist_id' => $request->id])->first();


        if(!$playlist){
            return "Такого плейлиста немає";
        }

        if(Auth::user()->id == $playlist->user_id){
            return view('myplaylist', ['playlist' => $playlist, 'comments' => $comments, 'user_id' => $userId]);
        }

        return view('playlist', ['playlist' => $playlist, 'like' => $like, 'comments' => $comments, 'follow' => $follow, 'user_id' => $userId]);
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

    public function addCommentReply(Request $request)
    {
        $message = $request->input('message');
        $userId = Auth::id();
        $playlistId = $request->id;
        $parentId = $request->input('parent_id');

        $comment = Comment::create(['user_id' => $userId, 
            'playlist_id' => $playlistId, 
            'message' => $message,
            'parent_id' => $parentId,
        ]);
        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        Comment::destroy($request->id);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $searchRequest = $request->input('search');
        
        $playlists = Playlist::with('user')->where('title', $searchRequest)->get();
        $albums = Album::with('artist')->where('title', $searchRequest)->get();
        $songs = Song::with('artist')->where('title', $searchRequest)->get();
        $artists = Artist::where('name', $searchRequest)->get();

        return view('searchResults', 
            ['playlists' => $playlists, 
            'albums' => $albums,
            'songs' => $songs,
            'artists' => $artists,
        ]);
    }
    
}
