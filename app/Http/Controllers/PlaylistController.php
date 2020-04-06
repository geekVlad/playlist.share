<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\Likes;
use App\Models\Artist;
use App\Models\Album;
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
            'description' => 'required|max:1000',
            'playlistimage' => 'file|mimes:jpg,jpeg,png',
        ]);

    if ($valid->fails()) {
      return redirect()
                ->back()
                ->withErrors($valid)
                ->withInput();
        }

        if($request->playlistimage){
            $destinationPath = public_path('images/playlist/');
            $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->playlistimage->extension(); 
            $request->playlistimage->move($destinationPath, $fileName);
        }else{
            $fileName = 'defaultPlaylistImage.jpg';
        }
        

        $playlist = new Playlist;

        $playlist->title = $request->title;
        $playlist->description = $request->description;
        $playlist->img = $fileName;
        $playlist->user_id = Auth::user()->id;

        $playlist->save();

        return redirect('playlist?id=' . $playlist->id );
    
    }

    public function EditPlaylistGet(Request $request)
    {
        $playlist = Playlist::where('id', $request->id)->first();

        if(!$playlist){
            return "Такий плейлист не існує";
        }

        return view('editplaylist',['playlist' => $playlist]);
        
        
    }

    public function EditPlaylistPost(Request $request)
    {

        $valid = Validator::make($request->all(), [
          'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'playlistimage' => 'file|mimes:jpg,jpeg,png',
        ]);

        if ($valid->fails()) {
          return redirect()
                    ->back()
                    ->withErrors($valid)
                    ->withInput();
            }

        $playlist = Playlist::where('id', $request->id)->first();

        if($request->playlistimage){

            $destinationPath = public_path('images/playlist/');
            unlink($destinationPath.$playlist->img);
            $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->playlistimage->extension();
            $playlist->img = $fileName;
            $request->playlistimage->move($destinationPath, $fileName);
        }

        $playlist->title = $request->title;
        $playlist->description = $request->description;

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

            return view('myplaylist', ['playlist' => $playlist, 'like' => $like, 'comments' => $comments]);
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

    public function AddSong(Request $request)
    {
        $valid = Validator::make($request->all(), [
          'title' => 'required|max:255',
            'artist' => 'required|max:255',
            'songimage' => 'file|mimes:jpg,jpeg,png',
            'album' => 'required|max:255',
            'day' => 'required|integer',
            'mounth' => 'required|integer',
            'year' => 'required|integer',
            'url' => 'url',
        ]);

        if ($valid->fails()) {
          return redirect()
                    ->back()
                    ->withErrors($valid)
                    ->withInput();
            }



        return $request;
    }

    public function getArtistAjax(Request $request){

        $search = $request->artist;

        $search = strtolower($search);
        $search=str_replace (' -', ' ', $search);
        $search=str_replace ('.', ' ', $search);
        $search=str_replace (',', ' ', $search);
        $search=str_replace ('!', ' ', $search);
        $search=str_replace ('?', ' ', $search);
        $search=str_replace (':', ' ', $search);
        $search=str_replace (';', ' ', $search);
        $search=str_replace (')', ' ', $search);
        $search=str_replace ('(', ' ', $search);
        $search=str_replace ('"', ' ', $search);
        $search = preg_replace("/\s{2,}/"," ",$search);

        //echo "\n<li>".$search."</li>";

        $artists = Artist::all();

        foreach ($artists as $artist) {

            $artist_name = $artist->name;
            $artist_name = strtolower($artist_name);
            $artist_name=str_replace (' -', ' ', $artist_name);
            $artist_name=str_replace ('.', ' ', $artist_name);
            $artist_name=str_replace (',', ' ', $artist_name);
            $artist_name=str_replace ('!', ' ', $artist_name);
            $artist_name=str_replace ('?', ' ', $artist_name);
            $artist_name=str_replace (':', ' ', $artist_name);
            $artist_name=str_replace (';', ' ', $artist_name);
            $artist_name=str_replace (')', ' ', $artist_name);
            $artist_name=str_replace ('(', ' ', $artist_name);
            $artist_name=str_replace ('"', ' ', $artist_name);
            $artist_name = preg_replace("/\s{2,}/"," ",$artist_name);

            if(stristr($artist_name, $search)){
                echo "\n<li>".$artist->name."</li>";
                echo "\n<input type=\"hidden\" name=\"id_artist\" value=\"".$artist->id."\">";
            }
        }
    }

    public function getAlbumAjax(Request $request){

        $search = $request->album;

        $search = strtolower($search);
        $search=str_replace (' -', ' ', $search);
        $search=str_replace ('.', ' ', $search);
        $search=str_replace (',', ' ', $search);
        $search=str_replace ('!', ' ', $search);
        $search=str_replace ('?', ' ', $search);
        $search=str_replace (':', ' ', $search);
        $search=str_replace (';', ' ', $search);
        $search=str_replace (')', ' ', $search);
        $search=str_replace ('(', ' ', $search);
        $search=str_replace ('"', ' ', $search);
        $search = preg_replace("/\s{2,}/"," ",$search);

        //echo "\n<li>".$search."</li>";

        $albums = Album::all();

        foreach ($albums as $album) {

            $album_title = $album->title;
            $album_title = strtolower($album_title);
            $album_title=str_replace (' -', ' ', $album_title);
            $album_title=str_replace ('.', ' ', $album_title);
            $album_title=str_replace (',', ' ', $album_title);
            $album_title=str_replace ('!', ' ', $album_title);
            $album_title=str_replace ('?', ' ', $album_title);
            $album_title=str_replace (':', ' ', $album_title);
            $album_title=str_replace (';', ' ', $album_title);
            $album_title=str_replace (')', ' ', $album_title);
            $album_title=str_replace ('(', ' ', $album_title);
            $album_title=str_replace ('"', ' ', $album_title);
            $album_title = preg_replace("/\s{2,}/"," ",$album_title);

            if(stristr($album_title, $search)){
                echo "\n<li>".$album->title."</li>";
                echo "\n<input type=\"hidden\" name=\"id_album\" value=\"".$album->id."\">";
            }
        }
        

    }
    
    
}
