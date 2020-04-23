@extends('layouts.app')

@section('content')
<style>
   .search{
   position:relative;
}
.search_result{
    background: #FFF;
    border: 1px #ccc solid;
    width: auto;
    border-radius: 4px;
    max-height:100px;
    overflow-y:scroll;
    display:none;
   }
.search_result li{
    list-style: none;
    padding: 5px 10px;
    margin: 0 0 0 -40px;
    color: #0896D3;
    border-bottom: 1px #ccc solid;
    cursor: pointer;
    transition:0.3s;
}
.search_result li:hover{
    background: #F9FF00;
}
</style>
	
    <!----Loader Start---->
	@include('components.loader')

    <!----Main Wrapper Start---->
    <div class="ms_main_wrapper">
        <!---Side Menu Start--->
        @include('components.sidemenu')
        <!---Main Content Start--->
        <div class="ms_content_wrapper padder_top80">
            <!---Header--->
           @include('components.header')

           <div class="ms-banner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="ms_banner_img">
                                <img src="{{ asset('images/playlist/'.$playlist->img)}}" alt="" class="img-fluid">
                            </div>
                            <div class="ms_banner_text">
                                <h1 class="ms_color">{{ $playlist->title }}</h1>
                                <p>{{ $playlist->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


           <div class="ms_free_download">
                <div class="ms_heading">
                    <h1>Songs</h1>
                </div>
                <div class="album_inner_list">
                    <div class="album_list_wrapper">
                        @foreach( $songs as $song)
                        <div class="ms_weekly_box">
                            <div class="weekly_left">
                                <span class="w_top_no">
                                </span>
                                <div class="w_top_song">
                                    <div class="w_tp_song_img">
                                        <img src="images/music/{{$song->song->img}}" alt="">
                                        <div class="ms_song_overlay">
                                        </div>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="w_tp_song_name">
                                        <h3><a href="#">{{$song->song->title}}</a></h3>      
                                        <p>{{$song->song->artist->name}}</p>
                                    </div>
                                </div>
                                <div class="w_top_song">
                                    <div class="w_tp_song_name">   
                                        <p>@if($song->song->album->id != 1){{$song->song->album->title}}@endif</p>
                                    </div>
                                </div>
                            </div>
                            <div class="weekly_right">
                                <span class="w_song_time">{{$song->song->duration}}</span>
                                <a href="deletesong?song_id={{$song->song->id}}&playlist_id={{$playlist->id}}">
                                    <span class="w_song_time"> 
                                        <img src="images/svg/close.svg" alt="">                    
                                    </span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <div class="ms_weekly_box">
                            <div class="weekly_left">
                                {{$songs->appends(['id' => $playlist->id])->links()}}
                            </div>
                        </div>
                        <form  id="formx" method="POST" runat="server" action="/addsong" enctype="multipart/form-data">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <div class="ms_profile_wrapper">
                                <h1>Додати пісню</h1>
                                <div class="ms_profile_box">
                                    <label for="FileImageSong">
                                        <div class="ms_pro_img">
                                            <img id="imgSong_url" src="{{asset('images/music/defaultSongImage.png')}}" alt="" class="img-fluid">
                                            <div class="pro_img_overlay">
                                                <i class="fa_icon edit_icon"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" name="songimage" id="FileImageSong" style="display: none;" onChange="imgSong_pathUrl(this);"/>
                                    @error('songimage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <script type="text/javascript">
                                        function imgSong_pathUrl(input){
                                            $('#imgSong_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                                        }
                                    </script>
                                    <div class="ms_pro_form addplaylist">
                                        <label>Назва</label>
                                        <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Реліз пісні</label>
                                        <p>
                                        <select name="day">
                                            <option disabled>Виберіть чистло</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                 @if (old('day') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                           
                                       </select>
                                       @error('day')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                       <select name="month">
                                            <option disabled>Виберіть місяць</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                 @if (old('month') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                       </select>
                                       @error('month')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror
                                       <select name="year">
                                            <option disabled>Виберіть рік</option>
                                            @for ($i = 1850; $i <= date('Y'); $i++)
                                                 @if (old('year') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                       </select>
                                       @error('year')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                     @enderror
                                        </p>
                                        <label>Посилання</label>
                                        <input type="text" name="url" value="{{old('url')}}" class="form-control">
                                        @error('url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label for="FileImageArtist">
                                        <div class="ms_pro_img">
                                            <img id="imgArtist_url" src="{{asset('images/artist/defaultArtistImage.png')}}" alt="" class="img-fluid">
                                            <div class="pro_img_overlay">
                                                <i class="fa_icon edit_icon"></i>
                                            </div>
                                        </div>
                                        </label>
                                        <input type="file" name="artistimage" id="FileImageArtist" style="display: none;" onChange="imgArtist(this);"/>
                                        @error('songimage')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <script type="text/javascript">
                                            function imgArtist(input){
                                                $('#imgArtist_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                                            }
                                        </script>
                                       <br><label>Виконавець</label>
                                        <input id="artist" type="text" name="artist" value="{{old('artist')}}" class="form-control" autocomplete="off" oninput="getArtist()">
                                        @error('artist')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <ul id="artist_search" class="search_result"></ul>
                                        <input id="artist_id" name="artist_id" type="hidden" value="{{old('artist_id')}}">
                                        <label for="FileImageAlbum">
                                        <div class="ms_pro_img">
                                            <img id="imgAlbum_url" src="{{asset('images/album/defaultAlbumImage.png')}}" alt="" class="img-fluid">
                                            <div class="pro_img_overlay">
                                                <i class="fa_icon edit_icon"></i>
                                            </div>
                                        </div>
                                        </label>
                                        <input type="file" name="albumimage" id="FileImageAlbum" style="display: none;" onChange="imgAlbum(this);"/>
                                        @error('songimage')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <script type="text/javascript">
                                            function imgAlbum(input){
                                                $('#imgAlbum_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                                            }
                                        </script>
                                        <br><label>Альбом</label>
                                        <input id="album" type="text" name="album" value="{{old('album')}}" autocomplete="off" class="form-control" oninput="getAlbum()">
                                        <ul id="album_search" class="search_result"></ul>
                                        @error('album')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Реліз альбому</label>
                                        <p>
                                        <select name="dayalbum">
                                            <option disabled>Виберіть чистло</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                 @if (old('dayalbum') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                           
                                       </select>
                                       @error('dayalbum')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                       <select name="monthalbum">
                                            <option disabled>Виберіть місяць</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                 @if (old('monthalbum') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                       </select>
                                       @error('monthalbum')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror
                                       <select name="yearalbum">
                                            <option disabled>Виберіть рік</option>
                                            @for ($i = 1850; $i <= date('Y'); $i++)
                                                 @if (old('yearalbum') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                       </select>
                                       @error('yearalbum')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </p>
                                        
                                        <input id="album_id" name="album_id" type="hidden" value="{{old('album_id')}}">
                                        <input name="playlistid" type="hidden" value="{{$playlist->id}}">
                                        <div class="pro-form-btn text-center marger_top15">
                                            <button class="ms_btn">Додати</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            @include('components.comments')
        </div>
    </div>
@endsection
