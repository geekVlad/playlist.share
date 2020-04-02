@extends('layouts.app')

@section('content')
	
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

            <div class="ms_weekly_wrapper">
                <div class="ms_weekly_inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Search results</h1>
                            </div>
                        </div>
                    @if( (count($playlists) == 0) && (count($artists) == 0) && (count($songs) == 0) && (count($albums) == 0) )
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>No search results</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">
                    @endif

                    <!---Playlists search results--->
                    @if( count($playlists) != 0 )
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Playlists</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">

                            @foreach( $playlists as $playlist)
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <div class="w_top_song">
                                        <div class="w_tp_song_img">
                                            <img src="{{ asset($playlist->img) }}" alt="" class="img-fluid">
                                            <div class="ms_song_overlay">
                                            </div>
                                            <div class="ms_play_icon">
                                                <img src="images/svg/play.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="w_tp_song_name">
                                            <h3><a href="http://project.test/playlist?id={{ $playlist->id }}">{{ $playlist->title }}</a></h3>
                                            <h3>By {{ $playlist->user->nickname }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="weekly_right">
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
                            <div class="ms_divider"></div>
                            @endforeach
                        </div>
                    @endif

                    <!---Albums search results--->
                    @if( count($albums) != 0 )
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Albums</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">

                            @foreach( $albums as $album)
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <div class="w_top_song">
                                        <div class="w_tp_song_img">
                                            <img src="{{ asset($album->img) }}" alt="" class="img-fluid">
                                            <div class="ms_song_overlay">
                                            </div>
                                            <div class="ms_play_icon">
                                                <img src="images/svg/play.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="w_tp_song_name">
                                            <h3><a href="http://project.test/album?id={{ $album->id }}">{{ $album->title }}</a></h3>
                                            <h3>{{ $album->artist->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="weekly_right">
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
                            <div class="ms_divider"></div>
                            @endforeach
                        </div>
                    @endif

                        <!---Songs search results--->
                    @if( count($songs) != 0 )
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Songs</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">

                            @foreach( $songs as $song)
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <div class="w_top_song">
                                        <div class="w_tp_song_img">
                                            <img src="{{ asset($song->img) }}" alt="" class="img-fluid">
                                            <div class="ms_song_overlay">
                                            </div>
                                            <div class="ms_play_icon">
                                                <img src="images/svg/play.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="w_tp_song_name">
                                            <h3>{{ $song->title }}</h3>
                                            <h3><a href="http://project.test/artist?id={{ $song->artist->id }}">{{ $song->artist->name }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="weekly_right">
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
                            <div class="ms_divider"></div>
                            @endforeach
                        </div>
                    @endif

                    @if( count($artists) != 0 )
                        <!---Artists search results--->
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Artists</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">

                            @foreach( $artists as $artist)
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <div class="w_top_song">
                                        <div class="w_tp_song_img">
                                            <img src="{{ asset($artist->img) }}" alt="" class="img-fluid">
                                            <div class="ms_song_overlay">
                                            </div>
                                            <div class="ms_play_icon">
                                                <img src="images/svg/play.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="w_tp_song_name">
                                            <h3><a href="http://project.test/artist?id={{ $artist->id }}">{{ $artist->name }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="weekly_right">
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
                            <div class="ms_divider"></div>
                            @endforeach
                        </div>
                    @endif

                    </div>
                </div>
            </div>

            
            <!----Main div close---->
        </div>
        <!----Footer Start---->
        @include('components.footer')
        <!----Audio Player Section---->
        
    </div>
    
			
    
@endsection