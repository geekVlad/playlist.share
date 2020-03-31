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

            <!---My Playlists--->
            <div class="ms_weekly_wrapper">
                <div class="ms_weekly_inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Search results</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">
                            @if( count($results) == 0 )
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <div class="w_top_song">
                                        <div class="w_tp_song_name">
                                            <h3>Playlist not found </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @foreach( $results as $result)
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <div class="w_top_song">
                                        <div class="w_tp_song_img">
                                            <img src="{{ asset($result->img) }}" alt="" class="img-fluid">
                                            <div class="ms_song_overlay">
                                            </div>
                                            <div class="ms_play_icon">
                                                <img src="images/svg/play.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="w_tp_song_name">
                                            <h3><a href="http://project.test/playlist?id={{ $result->id }}">{{ $result->title }}</a></h3>
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
                            </div>
                            <div class="ms_divider"></div>
                            @endforeach
                        </div>
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