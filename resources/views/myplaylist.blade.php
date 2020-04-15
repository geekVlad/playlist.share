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

           <div class="album_single_data">
                <div class="album_single_img">
                    <img src="{{ $playlist->img }}" alt="" class="img-fluid">
                </div>
                <div class="album_single_text">
                    <h2>{{ $playlist->title }}</h2>
                    <p class="singer_name">By - <a href='{{ url( "user/{$user->id}" ) }}'>{{ $user->nickname }}</a></p>
                    <p class="singer_name">Description: {{ $playlist->description }}</p>
                    <div class="album_feature">
                        <p>Count of songs: {{ $playlist->songs_count }} | Created: {{ $playlist->created_at }} | Last update: {{ $playlist->updated_at }}</p>
                        <p>Likes: {{ $playlist->likes_count }}  | Comments: {{ $playlist->comments_count }}  | Follows: {{ $playlist->follows_count }}</p>
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

           <div class="ms_free_download">
                <div class="ms_heading">
                    <h1>Songs</h1>
                </div>
                <div class="album_inner_list">
                    <div class="album_list_wrapper">
                        <ul class="album_list_name">
                            <li>#</li>
                            <li class="text-center">Song Title</li>
                            <li class="text-center">Album</li>
                            <li class="text-center">Artist</li>
                            <li class="text-center">Duration</li>
                            <li class="text-center">Add To Playlist</li>
                            <li class="text-center">Remove</li>
                        </ul>
                        @foreach( $playlist->songs as $song)
                        <ul>
                            <li><a href=""><span class="play_no">
                                @if( $loop->iteration < 10 )
                                        0{{ $loop->iteration }}
                                        @else
                                        {{ $loop->iteration }}
                                        @endif
                                </span>
                                <span class="play_hover">
                                    
                                </span></a>
                            </li>
                            <li class="text-center">
                                <a href="#"  onclick='
                                document.getElementById("player").src = "{{ $song->url }}";
                                '>{{ $song->title }}</a>

                            </li>
                            <li class="text-center"><a href="#">{{ $song->album->title }}</a></li>
                            <li class="text-center"><a href="#">{{ $song->artist->name }}</a></li>
                            <li class="text-center"><a href="#">{{ $song->duration }}</a></li>
                            <li class="text-center">
                            <div class="weekly_right">
                                    <span class="ms_more_icon" data-other="1">
                                        <img src="{{ asset('images/svg/more.svg') }}" alt="">
                                    </span>
                            </div>
                                <ul class="more_option">
                                    @if( (count($user->playlists) == 1))
                                    <li>
                                        <span class="opt_icon"><span class="icon icon_playlst"></span></span>You don't have more playlists
                                    </a></li>
                                    @endif
                                    
                                    @foreach( $user->playlists as $userPlaylist)
                                    @if( $userPlaylist->id != $playlist->id)
                                    <li><a href='{{ url( "addexistingsong/playlist/{$userPlaylist->id}/song/{$song->id}" ) }}'>
                                        <span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ $userPlaylist->title }}
                                    </a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="text-center"><a href="#"><span class="ms_close">
                                    <img src="{{ asset('images/svg/close.svg') }}" alt=""></span></a>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('components.comments')

            @include('components.player')
        </div>
    </div>
@endsection
