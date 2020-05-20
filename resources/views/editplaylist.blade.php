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
           <div class="ms_profile_wrapper">
                <h1>Редагувати плейлист</h1>
                <form method="POST" runat="server" action="/editplaylist" enctype="multipart/form-data">
	                <div class="ms_profile_box">
	                	<label for="myInputFile">
	  						<div class="ms_pro_img">
	                        	<img id="img_url" src="{{ asset('images/playlist/'.$playlist->img)}}" alt="" class="">
	                       		 <div class="pro_img_overlay">
	                            	<i class="fa_icon edit_icon"></i>
	                       		 </div>
	                   		 </div>
	  						<input type="file" name="playlistimage" id="myInputFile" style="display: none;" onChange="img_pathUrl(this);"/>
	  						@error('playlistimage')
                                <div class="alert alert-danger">{{ $message }}</div>
                             @enderror
						</label>
						<script type="text/javascript">
							function img_pathUrl(input){
							    $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
							}
						</script>
	                    <div class="ms_pro_form addplaylist">
	                        @csrf
	                        <label>Назва плейлиста</label>
	                        <input type="text" name="title" value="{{old('title') ? old('title') : $playlist->title}}" class="form-control">
	                         @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                             @enderror
	                        <label>Опис плейлиста</label>
	                        <textarea type="text" name="description" class="form-control text-area-description">{{old('description') ? old('description') : $playlist->description}}</textarea>
	                        @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
		                    <div class="pro-form-btn text-center marger_top15">
		                        <button class="ms_btn">Змінити</button>
		                    </div>
	                    </div>
	                </div>
	                 <input type="hidden" name="id" value="{{$playlist->id}}">
                </form>
            </div>
		</div>
	</div>
@endsection