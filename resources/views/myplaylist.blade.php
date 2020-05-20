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
                    <!-- <a href="#" id="player" v-on:click="formedPlayerUrls()" class="ms_btn play_btn"><span class="play_all"><img src="{{ asset('images/svg/play_all.svg') }}" alt="">Play All</span></a> -->

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
                    <div class="album_list_wrapper" id="playlist">
                        <ul class="album_list_name">
                            <li>#</li>
                            <li class="text-center">Song Title</li>
                            <li class="text-center">Album</li>
                            <li class="text-center">Artist</li>
                            <li class="text-center">Duration</li>
                            <li class="text-center">Add To Playlist</li>
                            <li class="text-center">Remove</li>
                        </ul>

                        @if( $playlist->songs->count() == 0 )
                        <ul>
                            <li><a href="#"></a></li>
                            <li class="text-left"><a href=""></a></li>
                            <li class="text-center"><a href="#"></a></li>
                            <li class="text-center"><a href="#">[Looks like there is no songs yet]</a></li>
                            <li class="text-center"><a href="#"></a></li>
                            <li class="text-center"><a href="#"></li>
                            <li class="text-center"></li>
                        </ul>
                        @endif

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
                                <a href="#"  v-on:click='changeIdsQueue("{{ $song->url }}")'>{{ $song->title }}</a>

                            </li>
                            <li class="text-center"><a href="#" >{{ $song->album->title }}</a></li>
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
                        
                        <form  id="formx" method="POST" runat="server" action="/addsong" enctype="multipart/form-data">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <div class="ms_profile_wrapper">
                                <h1>Додати пісню</h1>
                                <div class="ms_profile_box">
                                    <label for="FileImageSong">
                                        <div class="ms_pro_img">
                                            <img id="imgSong_url" src="{{asset('images/music/defaultSongImage.png')}}" alt="" class="img-fluid">
                                            <div class="pro_img_overlay">
                                                <i class="fa_icon edit_icon"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" name="songimage" id="FileImageSong" style="display: none;" onChange="imgSong_pathUrl(this);"/>
                                    @error('songimage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <script type="text/javascript">
                                        function imgSong_pathUrl(input){
                                            $('#imgSong_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                                        }
                                    </script>
                                    <div class="ms_pro_form addplaylist">
                                        <label>Назва</label>
                                        <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Реліз пісні</label>
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
                                        <label for="FileImageArtist">
                                        <div class="ms_pro_img">
                                            <img id="imgArtist_url" src="{{asset('images/artist/defaultArtistImage.png')}}" alt="" class="img-fluid">
                                            <div class="pro_img_overlay">
                                                <i class="fa_icon edit_icon"></i>
                                            </div>
                                        </div>
                                        </label>
                                        <input type="file" name="artistimage" id="FileImageArtist" style="display: none;" onChange="imgArtist(this);"/>
                                        @error('songimage')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <script type="text/javascript">
                                            function imgArtist(input){
                                                $('#imgArtist_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                                            }
                                        </script>
                                       <br><label>Виконавець</label>
                                        <input id="artist" type="text" name="artist" value="{{old('artist')}}" class="form-control" autocomplete="off" oninput="getArtist()">
                                        @error('artist')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <ul id="artist_search" class="search_result"></ul>
                                        <input id="artist_id" name="artist_id" type="hidden" value="{{old('artist_id')}}">
                                        <label for="FileImageAlbum">
                                        <div class="ms_pro_img">
                                            <img id="imgAlbum_url" src="{{asset('images/album/defaultAlbumImage.png')}}" alt="" class="img-fluid">
                                            <div class="pro_img_overlay">
                                                <i class="fa_icon edit_icon"></i>
                                            </div>
                                        </div>
                                        </label>
                                        <input type="file" name="albumimage" id="FileImageAlbum" style="display: none;" onChange="imgAlbum(this);"/>
                                        @error('songimage')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <script type="text/javascript">
                                            function imgAlbum(input){
                                                $('#imgAlbum_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                                            }
                                        </script>
                                        <br><label>Альбом</label>
                                        <input id="album" type="text" name="album" value="{{old('album')}}" autocomplete="off" class="form-control" oninput="getAlbum()">
                                        <ul id="album_search" class="search_result"></ul>
                                        @error('album')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Реліз альбому</label>
                                        <p>
                                        <select name="dayalbum">
                                            <option disabled>Виберіть чистло</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                 @if (old('dayalbum') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                           
                                       </select>
                                       @error('dayalbum')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                       <select name="monthalbum">
                                            <option disabled>Виберіть місяць</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                 @if (old('monthalbum') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                       </select>
                                       @error('monthalbum')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror
                                       <select name="yearalbum">
                                            <option disabled>Виберіть рік</option>
                                            @for ($i = 1850; $i <= date('Y'); $i++)
                                                 @if (old('yearalbum') == $i)
                                                 <option value="{{ $i }}" selected>{{ $i }}</option>
                                                 @else
                                                 <option value="{{ $i }}" >{{ $i }}</option>
                                                 @endif
                                            @endfor
                                       </select>
                                       @error('yearalbum')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </p>
                                        
                                        <input id="album_id" name="album_id" type="hidden" value="{{old('album_id')}}">
                                        <input name="playlistid" type="hidden" value="{{$playlist->id}}">
                                        <div class="pro-form-btn text-center marger_top15">
                                            <button class="ms_btn">Додати</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            @include('components.comments')

            @if( $playlist->songs->count() > 0 )
            @include('components.player')
            @endif
        </div>
    </div>
@endsection
