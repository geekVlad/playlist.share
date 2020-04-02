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

            <!--- Album --->

        <div class="ms_album_single_wrapper ms_artist_single">
            <div class="album_single_data">
                <div class="album_single_img">
                    <img src="{{ $album->img }}" alt="" class="img-fluid">
                </div>
                <div class="album_single_text">
                    <h2>{{ $album->title }}</h2>
                    <div class="album_btn">
                        <a href="#" class="ms_btn play_btn"><span class="play_all"><img src="images/svg/play_all.svg" alt="">Play All</span><span class="pause_all"><img src="images/svg/pause_all.svg" alt="">Pause</span></a>
                        <a href="#" class="ms_btn"><span class="play_all"><img src="images/svg/add_q.svg" alt="">Add To Queue</span></a>
                    </div>
                </div>
                <div class="album_more_optn ms_more_icon">
                    <span><img src="images/svg/more.svg" alt=""></span>
                </div>
                <ul class="more_option">
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                </ul>
            </div>

            <!----Songs ---->
            <div class="album_inner_list">
                <div class="ms_heading">
                    <h1>Songs</h1>
                </div>
                <div class="album_list_wrapper">
                    <ul class="album_list_name">
                        <li>#</li>
                        <li>Song Title</li>
                        <li class="text-center">Duration</li>
                        <li class="text-center">Add To Favourites</li>
                        <li class="text-center">More</li>
                    </ul>
                    @foreach($songs as $song)
                    <ul>
                        <li><a href="#"><span class="play_no">
                            @if($loop->iteration<10)
                            0{{ $loop->iteration }}
                                        @else
                                        {{ $loop->iteration }}
                                        @endif
                        </span><span class="play_hover"></span></a></li>
                        <li><a href="#">{{ $song->title }}</a></li>
                        <li class="text-center"><a href="#">{{ $song->duration }}</a></li>
                        <li class="text-center"><a href="#"><span class="ms_icon1 ms_fav_icon"></span></a></li>
                        <li class="text-center ms_more_icon"><a href="javascript:;"><span class="ms_icon1 ms_active_icon"></span></a>
                            <ul class="more_option">
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
            <div class="ms_view_more padder_bottom20">
                <a href="#" class="ms_btn">view more</a>
            </div>

        </div>
            
        

            <!----Main div close---->
        </div>
        <!----Footer Start---->
        @include('components.footer')
        <!----Audio Player Section---->
        
    </div>
    
            
    
@endsection