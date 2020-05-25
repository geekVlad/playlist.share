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