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
use App\Models\Follow;
use App\Models\playlist_song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



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

        return redirect('playlist/' . $playlist->id );
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
        $user = Auth::user();
        $user->with('playlists');

        $like = Likes::where(['user_id' => $user->id, 'playlist_id' => $request->id])->first();

        $playlist = Playlist::with(['songs.artist', 'songs.album', 'user'])->where('id', $request->id)->first();

        $comments = Comment::with('user')->with('childrens')->where('playlist_id', $playlist->id)->orderBy('updated_at', 'Desc')->get();

        $follow = Follow::where(['user_id' => $user->id, 'playlist_id' => $request->id])->first();

        $playlistQueue = PlaylistController::formPlaylistQueue($playlist->songs);

        if(!$playlist){
            return "404";
        }

        $songs = playlist_song::with('song.artist','song.album')->where('playlist_id', $request->id)->paginate(10);

        if(Auth::user()->id == $playlist->user_id){
            return view('myplaylist', ['playlist' => $playlist, 'comments' => $comments, 'user' => $user, 'playlistQueue' => $playlistQueue]);
        }

        return view('playlist', ['playlist' => $playlist, 'like' => $like, 'comments' => $comments, 'follow' => $follow, 'user' => $user, 'playlistQueue' => $playlistQueue]);
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

        $user = Auth::user();
        $user->with('playlists');
        
        $playlists = Playlist::with('user')->where('title', $searchRequest)->get();
        $albums = Album::with('artist')->where('title', $searchRequest)->get();
        $songs = Song::with('artist')->where('title', $searchRequest)->get();
        $artists = Artist::where('name', $searchRequest)->get();

        $playlistQueue = PlaylistController::formPlaylistQueue($songs);

        return view('searchResults', 
            ['playlists' => $playlists, 
            'albums' => $albums,
            'songs' => $songs,
            'artists' => $artists,
            'user' => $user,
            'playlistQueue' => $playlistQueue,
            ]);
    }

    public function addExistingSong(Request $request)
    {
        
        $playlistId = $request->playlist_id;
        $songId = $request->song_id;

        if(playlist_song::where([ ['playlist_id', $playlistId], ['song_id', $songId] ])->first()){
            return view('songExistsInPlaylist');
        }

        $add_song = playlist_song::create([
            'playlist_id' => $playlistId, 
            'song_id' => $songId,
        ]);
        return redirect()->back();
    }

    public static function formPlaylistQueue($songs)
    {
        $playlistQueue = "";
        foreach ($songs as $song) {
            $playlistQueue = $playlistQueue . $song->url . ',';
        }
        $playlistQueue = Str::beforeLast($playlistQueue, ',');

        return $playlistQueue;
    }

    public function AddSong(Request $request)
    {

        $valid = Validator::make($request->all(), [
          'title' => 'required|max:255',
            'artist' => 'required|max:255',
            'songimage' => 'file|mimes:jpg,jpeg,png',
            'artistimage' => 'file|mimes:jpg,jpeg,png',
            'albumimage' => 'file|mimes:jpg,jpeg,png',
            'album' => 'max:255',
            'day' => 'required|integer',
            'month' => 'required|integer',
            'year' => 'required|integer',
            'dayalbum' => 'required|integer',
            'monthalbum' => 'required|integer',
            'yearalbum' => 'required|integer',
            'playlistid' => 'required|integer',
            'url' => 'url',
        ]);


        if ($valid->fails()) {
          return redirect()
                    ->back()
                    ->withErrors($valid)
                    ->withInput();
            }

    //перевіряємо на валідність посилання, і дістаємо id відео
        $url = $request->url;
        if (stripos($url, 'youtube.com') !== false) {
            preg_match('#v=([^\&]+)#is', $url, $videoId);
            if (count ($videoId) <= 0) {
                return redirect()
                    ->back()
                    ->withErrors(['url' => 'Посилання не відповідє вимогам'])
                    ->withInput();
            }
        }else{
            return redirect()
                    ->back()
                    ->withErrors(['url' => 'Посилання не відповідє вимогам'])
                    ->withInput();
        }
    //Отримуємо довжину відео
    $api_key = "AIzaSyA62DlQS_T2Kefb-zXDElEYxNAs8HRakA4";
    $get_data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&id=".$videoId[1]."&key=".$api_key);
    $get_data = json_decode($get_data, true);
    $result_time = $get_data["items"]["0"]["contentDetails"]["duration"];

    $result_time = new \DateInterval($result_time);
    $total_sec = $result_time->days * 86400 + $result_time->h * 3600 + $result_time->i * 60 + $result_time->s;
    $total_time = new \DateTime("@".$total_sec);

    $duration = $total_time->format("H:i:s");

    //Додаємо виконавця
        if($request->artist_id){
            $artist_id = $request->artist_id;
        }else{
            if($request->artistimage){
                $destinationPath = public_path('images/artist/');
                $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->artistimage->extension(); 
                $request->artistimage->move($destinationPath, $fileName);
            }else{
                $fileName = 'defaultArtistImage.jpg';
            }

            $artist = new Artist;
            $artist->name = $request->artist;
            $artist->img = $fileName;
            $artist->save();
            $artist_id = $artist->id;
        }
    
    //Додаємо альбом
        if($request->album_id){
            $album_id = $request->album_id;
        }else{
            if($request->album){
                if($request->albumimage){
                    $destinationPath = public_path('images/album/');
                    $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->albumimage->extension(); 
                    $request->albumimage->move($destinationPath, $fileName);
                }else{
                    $fileName = 'defaultAlbumImage.jpg';
                }

                $album = new Album;
                $album->title = $request->album;
                $album->artist_id = $artist_id;
                $album->img = $fileName;
                $album->released_date = $request->dayalbum.".".$request->monthalbum.".".$request->yearalbum;
                $album->save();
                $album_id = $album->id;
            }else{
                $album_id = false;
            }
            
        }

    //Додаємо пісню
        
        if($request->songimage){
            $destinationPath = public_path('images/music/');
            $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->songimage->extension(); 
            $request->songimage->move($destinationPath, $fileName);
        }else{
            $fileName = 'defaultSongImage.png';
        }

        $song = new Song;
        $song->title = $request->title;
        $song->artist_id = $artist_id;
        $song->duration = $duration;
        if($album_id){$song->album_id = $album_id;}else{$song->album_id = "1";}
        $song->released_date = $request->day.".".$request->month.".".$request->year;
        $song->img = $fileName;
        $song->url = $videoId[1];   
        $song->save();
        $song_id = $song->id;
        
    //Привязуємо пісню до плейлиста

        $playlist_song = new playlist_song;
        $playlist_song->song_id = $song_id;
        $playlist_song->playlist_id = $request->playlistid;
        $playlist_song->save();

        return redirect()->back();

    }

    public function DeleteSong(Request $request){

        $playlist_song = playlist_song::with('playlist')->where(['song_id' => $request->song_id, 'playlist_id' => $request->playlist_id])->get()->first();

        if($playlist_song){
            if(Auth::id() == $playlist_song->playlist->user_id){
                $playlist_song = playlist_song::where(['song_id' => $request->song_id, 'playlist_id' => $request->playlist_id])->delete();

            }else {
                return "404";
            }
        }else{
            return "404";
        }
        

        return redirect()->back();

        


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
                echo "\n<li id=\"".$artist->id."\" onClick=\"artist_click(this.id)\">".$artist->name."</li>";
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
                echo "\n<li id=\"".$album->id."\" onClick=\"album_click(this.id)\">".$album->title."</li>";
            }
        }
        

    }
    
}
