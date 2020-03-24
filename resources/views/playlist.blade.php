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
                                <img src="{{ $playlist->img }}" alt="" class="img-fluid">
                            </div>
                            <div class="ms_banner_text">
                                <h1 class="ms_color">{{ $playlist->title }}</h1>
                                <p>{{ $playlist->description }}</p>
                                <div class="ms_banner_btn">
                                    <a href="playlist_un_liked?id={{$playlist->id}}" class="ms_btn">Unlike</a>
                                    <a href="playlistliked?id={{$playlist->id}}" class="ms_btn">Like</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <div class="ms_weekly_wrapper ms_free_music">
                <div class="ms_weekly_inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Songs</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">
                            @foreach( $playlist->songs as $song)
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
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
                                            <h3><a href="#">{{ $song->title }}</a></h3>
                                            <p>{{ $song->artist_id }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="weekly_right">
                                    <span class="w_song_time">5:10</span>
                                    <span class="ms_more_icon" data-other="1">
                                        <img src="images/svg/more.svg" alt="">                                  
                                    </span>

                                    <!-- que_close -->
                                     <span href="" class="que_close">  
                                        <img src="{{ asset('images/svg/close.svg') }}">
                                    </span> 
                                </div>
                                <ul class="more_option">
                                    <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                    <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                                </ul>
                            </div>
                        </div>
                </div>
                <div class="ms_divider"></div>
                @endforeach
            </div>
@endsection
