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

           <div class="album_single_data">
                <div class="album_single_img">
                    <img src="{{ $playlist->img }}" alt="" class="img-fluid">
                </div>
                <div class="album_single_text">
                    <h2>{{ $playlist->title }}</h2>
                    <p class="singer_name">By - {{ $playlist->user_id }}</p>
                    <div class="album_feature">
                        <a href="#" class="album_date">5 song | 25:10</a>
                        <a href="#" class="album_date">Created {{ $playlist->created_at }}  | Abc Music Company</a>
                    </div>
                    <div class="album_btn">
                        @if ( $like==null )
                                    <a href="playlistliked?id={{$playlist->id}}" class="ms_btn">Like</a>
                                    @else
                                    <a href="playlist_unliked?id={{$playlist->id}}" class="ms_btn">Unlike</a>
                                    @endif

                                    @if ( $follow==null )
                                    <a href="playlistfollowed?id={{$playlist->id}}" class="ms_btn">Follow</a>
                                    @else
                                    <a href="playlist_unfollowed?id={{$playlist->id}}" class="ms_btn">Unfollow</a>
                                    @endif
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

           <!-- <div class="ms-banner">
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
                                    @if ( $like==null )
                                    <a href="playlistliked?id={{$playlist->id}}" class="ms_btn">Like</a>
                                    @else
                                    <a href="playlist_unliked?id={{$playlist->id}}" class="ms_btn">Unlike</a>
                                    @endif

                                    @if ( $follow==null )
                                    <a href="playlistfollowed?id={{$playlist->id}}" class="ms_btn">Follow</a>
                                    @else
                                    <a href="playlist_unfollowed?id={{$playlist->id}}" class="ms_btn">Unfollow</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="ms_free_download">
                <div class="ms_heading">
                    <h1>Songs</h1>
                </div>
                <div class="album_inner_list">
                    <div class="album_list_wrapper">
                        <ul class="album_list_name">
                            <li>#</li>
                            <li>Song Title</li>
                            <li>Album</li>
                            <li class="text-center">Duration</li>
                            <li class="text-center">Add To Favourites</li>
                            <li class="text-center">More</li>
                        </ul>
                        @foreach( $playlist->songs as $song)
                        <ul>
                            <li><a href="#"><span class="play_no">01</span><span class="play_hover"></span></a></li>
                            <li><a href="#">{{ $song->title }}</a></li>
                            <li><a href="#">{{ $song->artist_id }}</a></li>
                            <li class="text-center"><a href="#">5:26</a></li>
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
            </div>

            @include('components.comments')

        </div>
    </div>
               
@endsection
