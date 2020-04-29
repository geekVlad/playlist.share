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

            <!--- Artist --->

        <div class="ms_album_single_wrapper ms_artist_single">
            <div class="album_single_data">
                <div class="album_single_img">
                    <img src="{{ $artist->img }}" alt="" class="img-fluid">
                </div>
                <div class="album_single_text">
                    <h2>{{ $artist->name }}</h2>
                    <div class="album_btn">
                        <a href="#" class="ms_btn play_btn"><span class="play_all"><img src="{{ asset('images/svg/play_all.svg') }}" alt="">Play All</span><span class="pause_all"><img src="{{ asset('images/svg/pause_all.svg') }}" alt="">Pause</span></a>
                        <a href="#" class="ms_btn"><span class="play_all"><img src="{{ asset('images/svg/add_q.svg') }}" alt="">Add To Queue</span></a>
                    </div>
                </div>
                <div class="album_more_optn ms_more_icon">
                    <span><img src="{{ asset('images/svg/more.svg') }}" alt=""></span>
                </div>
                <ul class="more_option">
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                    <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                </ul>
            </div>

            <!--- Albums --->
            @if( (count($albums) != 0))
            <div class="ms_top_artist">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>Albums</h1>
                            </div>
                        </div>
                        @foreach( $albums as $album)
                        <div class="col-lg-2 col-md-6">
                            <div class="ms_rcnt_box marger_bottom30">
                                <div class="ms_rcnt_box_img">
                                    <img src="{{ asset($album->img) }}" alt="" class="img-fluid">
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_more_icon">
                                            <img src="{{ asset('images/svg/more.svg') }}" alt="">
                                        </div>
                                        <ul class="more_option">
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                                        </ul>
                                        <div class="ms_play_icon">
                                            <img src="{{ asset('images/svg/play.svg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href='{{ url( "album/{$album->id}" ) }}'>{{ $album->title }}</a></h3>
                                    <h3>{{ $album->released_date }}</h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            @endif

            @if( (count($singles) != 0))
            <!----Singles ---->
            <div class="album_inner_list">
                <div class="ms_heading">
                    <h1>Singles</h1>
                </div>
                <div class="album_list_wrapper" id="playlist">
                    <ul class="album_list_name">
                        <li>#</li>
                        <li>Song Title</li>
                        <li>Artist</li>
                        <li class="text-center">Duration</li>
                        <li class="text-center">Add To Queue</li>
                        <li class="text-center">Add To Playlist</li>
                    </ul>
                    @foreach($singles as $single)
                    <ul>
                        <li><a href="#"><span class="play_no">
                            @if($loop->iteration<10)
                            0{{ $loop->iteration }}
                                        @else
                                        {{ $loop->iteration }}
                                        @endif
                        </span><span class="play_hover"></span></a></li>
                        <li><a href="#" v-on:click='changeIdsQueue("{{ $single->url }}")'>{{ $single->title }}</a></li>
                        <li><a href="#">{{ $artist->name }}</a></li>
                        <li class="text-center"><a href="#">{{ $single->duration }}</a></li>
                        <li class="text-center"><a href="#"><span class="ms_icon1 ms_fav_icon"></span></a></li>
                        <li class="text-center">
                            <div class="weekly_right">
                                    <span class="ms_more_icon" data-other="1">
                                        <img src="{{ asset('images/svg/more.svg') }}" alt="">
                                    </span>
                                </div>
                                <ul class="more_option">
                                    @if( (count($user->playlists) == 0))
                                    <li>
                                        <span class="opt_icon"><span class="icon icon_playlst"></span></span>You don't have playlists
                                    </a></li>
                                    @endif
                                    
                                    @foreach( $user->playlists as $userPlaylist)
                                    <li><a href='{{ url( "addexistingsong/playlist/{$userPlaylist->id}/song/{$single->id}" ) }}'>
                                        <span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ $userPlaylist->title }}
                                    </a></li>
                                    @endforeach
                                </ul>
                            </li>
                    </ul>
                    @endforeach
                </div>
            </div>
            @endif
            <!-- <div class="ms_view_more padder_bottom20">
                <a href="#" class="ms_btn">view more</a>
            </div> -->

        </div>
            
        @if( $singles->count() > 0 )
            @include('components.player')
        @endif

            <!----Main div close---->
        </div>
        <!----Footer Start---->
        @include('components.footer')
        <!----Audio Player Section---->
        
    </div>
    
            
    
@endsection