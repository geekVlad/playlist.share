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

    <!----Main Wrapper Start---->s
    <div class="ms_main_wrapper">
        <!---Side Menu Start--->
        @include('components.sidemenu')
        <!---Main Content Start--->
        <div class="ms_content_wrapper padder_top80">
            <!---Header--->
           @include('components.header')
           <div class="ms_free_download">
                <div class="ms_heading">
                    <h1>Songs</h1>
                </div>
                <div class="album_inner_list">
                    <div class="album_list_wrapper">
                        <div class="ms_weekly_box">
                            <div class="weekly_left">
                                <span class="w_top_no">
                                    01
                                </span>
                                <div class="w_top_song">
                                    <div class="w_tp_song_img">
                                        <img src="images/weekly/song1.jpg" alt="">
                                        <div class="ms_song_overlay">
                                        </div>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="w_tp_song_name">
                                        <h3><a href="#">Until I Met You</a></h3>
                                        <p>Ava Cornish</p>
                                    </div>
                                </div>
                            </div>
                            <div class="weekly_right">
                                <span class="w_song_time">5:10</span>
                                <span class="ms_more_icon" data-other="1">
                                    <img src="images/svg/more.svg" alt="">                                  
                                </span>
                            </div>
                            <ul class="more_option">
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                            </ul>
                        <form  id="formx" method="POST" runat="server" action="/addsong" enctype="multipart/form-data">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <div class="ms_profile_wrapper">
                                <h1>Додати пісню</h1>
                                <div class="ms_profile_box">
                                    <label for="myInputFile">
                                        <div class="ms_pro_img">
                                            <img id="img_url" src="{{asset('images/playlist/defaultPlaylistImage.jpg')}}" alt="" class="img-fluid">
                                            <div class="pro_img_overlay">
                                                <i class="fa_icon edit_icon"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" name="songimage" id="myInputFile" style="display: none;" onChange="img_pathUrl(this);"/>
                                    @error('songimage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <script type="text/javascript">
                                        function img_pathUrl(input){
                                            $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                                        }
                                    </script>
                                    <div class="ms_pro_form addplaylist">
                                        <label>Назва</label>
                                        <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Виконавець</label>
                                        <input id="artist" type="text" name="artist" value="{{old('artist')}}" class="form-control" autocomplete="off" oninput="getArtist()">
                                        @error('artist')
                                        <input id="artist_id" type="hidden" value="";
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <ul id="artist_search" class="search_result"></ul>
                                        <label>Альбом</label>
                                        <input id="album" type="text" name="album" value="{{old('album')}}" autocomplete="off" class="form-control" oninput="getAlbum()">
                                        @error('album')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <ul id="album_search" class="search_result"></ul>
                                        <label>Реліз</label>
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
                                        <div class="pro-form-btn text-center marger_top15">
                                            <button class="ms_btn">Додати</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('components.comments')
        </div>
    </div>
@endsection
