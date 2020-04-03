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
           
           <div class="ms-banner">
                <div class="container-fluid">
                </div>
            </div>
            <!---Banner--->
            <!-- <div class="ms-banner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="ms_banner_img">
                                <img src="images/banner.png" alt="" class="img-fluid">
                            </div>
                            <div class="ms_banner_text">
                                <h1>This Month’s</h1>
                                <h1 class="ms_color">Record Breaking Albums !</h1>
                                <p>Dream your moments, Until I Met You, Gimme Some Courage, Dark Alley, One More Of A Stranger, Endless<br> Things, The Heartbeat Stops, Walking Promises, Desired Games and many more...</p>
                                <div class="ms_banner_btn">
                                    <a href="#" class="ms_btn">Listen Now</a>
                                    <a href="#" class="ms_btn">Add To Queue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!---My Playlists--->
            <div class="ms_rcnt_slider">
                <div class="ms_heading">
                    <h1>My playlists</h1>
                    <span class="veiw_all"><a href="http://project.test/myplaylists">view more</a></span>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        @foreach( $myPlaylists as $playlist )              
                        <div class="swiper-slide">
                            <div class="ms_rcnt_box">
                                <div class="ms_rcnt_box_img">
                                    <img src= "{{ asset($playlist->img) }}" alt="">
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_more_icon">
                                            <img src="images/svg/more.svg" alt="">
                                        </div>
                                        <ul class="more_option">
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                                        </ul>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href="http://project.test/playlist?id={{ $playlist->id }}">{{ $playlist->title }}</a></h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next slider_nav_next"></div>
                <div class="swiper-button-prev slider_nav_prev"></div>
            </div>
            <!---Weekly Top 15--->
            <div class="ms_weekly_wrapper">
                <div class="ms_weekly_inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>weekly top 15</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">
                            @foreach( $top15 as $playlist)
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <span class="w_top_no">

										@if( $loop->iteration < 10 )
                                        0{{ $loop->iteration }}
                                        @else
                                        {{ $loop->iteration }}
                                        @endif

									</span>
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
                                            <h3>By <a href="http://project.test/user?id={{ $playlist->user->id }}">{{ $playlist->user->nickname }}</a></h3>
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
            
            <!----New Playlists Section Start---->
            <div class="ms_releases_wrapper">
                <div class="ms_heading">
                    <h1>New Playlists</h1>
                    <span class="veiw_all"><a href="#">view more</a></span>
                </div>
                <div class="ms_release_slider swiper-container">
                    <div class="ms_divider"></div>
                    <div class="swiper-wrapper">
                        
                        @foreach($newPlaylists as $playlist)
                        <div class="swiper-slide">
                            <div class="ms_release_box">
                                <div class="w_top_song">
                                    <span class="slider_dot"></span>
                                    <div class="w_tp_song_img">
                                        <img src="{{ $playlist->img }}" alt="">
                                        <div class="ms_song_overlay">
                                        </div>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="w_tp_song_name">
                                        <h3><a href="http://project.test/playlist?id={{ $playlist->id }}">{{ $playlist->title }}</a></h3>
                                        <h3>By <a href="http://project.test/user?id={{ $playlist->user->id }}">{{ $playlist->user->nickname }}</a></h3>
                                    </div>
                                </div>
                                <div class="weekly_right">
                                    <span class="w_song_time">5:10</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next2 slider_nav_next"></div>
                <div class="swiper-button-prev2 slider_nav_prev"></div>
            </div>
                                          
            <!----Main div close---->
        </div>
        <!----Footer Start---->
        @include('components.footer')
        <!----Audio Player Section---->
        
    </div>
    
	
    
@endsection