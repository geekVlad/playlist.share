@extends('layouts.app')

@section('content')
	
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
                                <div class="ms_banner_btn">
                                    @if ( $like==null )
                                    <a href="playlistliked?id={{$playlist->id}}" class="ms_btn">Like</a>
                                    @else
                                    <a href="playlist_un_liked?id={{$playlist->id}}" class="ms_btn">Unlike</a>
                                    @endif
                                </div>
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
                        </div>
                        @endforeach
                        <div class="ms_weekly_box">
                            <div class="weekly_left">
                                {{$songs->appends(['id' => $playlist->id])->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.comments')

        </div>
    </div>
               
@endsection
