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
                <div class="album_single_text">
                    <h2>This song already exists in selected playlist</h2>
                    @if( url()->previous() != 'http://project.test/search' )
                    <div class="album_btn">
                        <a href="{{ url()->previous() }}" class="ms_btn">Go back</a>
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