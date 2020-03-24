<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Playlist;
use App\Models\Song;
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

    public function ShowPlaylist(Request $request){
        $playlist = Playlist::where('id', $request->id)->first();

        if(!$playlist){
            return "Такого плейлиста немає";
        }

        if(Auth::user()->id == $playlist->user_id){
            return view('myplaylist', compact('playlist'));
        }

        return view('playlist', compact('playlist'));
    }
    
}
