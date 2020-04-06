@extends('layouts.app')

@section('content')
<div class="ms_register_popup">
            <div class="modal-dialog register_dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="ms_register_img">
                            <img src="{{ asset('images/register_img.png') }}" alt="" class="img-fluid" />
                        </div>
                        <form method="POST" action="{{ url('register') }}">
                        @csrf
                            <div class="ms_register_form">
                                <h2>Register / Sign Up</h2>
                                <div class="form-group">
                                    <input name="first_name" type="text" placeholder="Enter Your First Name" 
                                    class="@error('first_name') is-invalid @enderror form-control" value="{{ old('first_name') }}">

                                    @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <span class="form_icon">
                                <i class="fa_icon form-user" aria-hidden="true"></i>
                                </span>
                                </div>

                                <div class="form-group">
                                    <input name="last_name" type="text" placeholder="Enter Your Last Name" class="@error('last_name') is-invalid @enderror form-control" value="{{ old('last_name') }}">

                                    @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <span class="form_icon">
                                <i class="fa_icon form-user" aria-hidden="true"></i>
                                </span>
                                </div>
                                <div class="form-group">
                                    <input name="nickname" type="text" placeholder="Enter Your Nickname" class="@error('nickname') is-invalid @enderror form-control" value="{{ old('nickname') }}">

                                    @error('nickname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <span class="form_icon">
                                <i class="fa_icon form-user" aria-hidden="true"></i>
                                </span>
                                </div>
                                <div class="form-group">
                                    <input name="email" type="text" placeholder="Enter Your Email" class="@error('email') is-invalid @enderror form-control" value="{{ old('email') }}">

                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <span class="form_icon">
                                <i class="fa_icon form-envelope" aria-hidden="true"></i>
                            </span>
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" placeholder="Enter Password" class="@error('last_name') is-invalid @enderror form-control">

                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <span class="form_icon">
                            <i class="fa_icon form-lock" aria-hidden="true"></i>
                            </span>
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" placeholder="Confirm Password" class="@error('last_name') is-invalid @enderror form-control">

                                    @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                    <span class="form_icon">
                            <i class=" fa_icon form-lock" aria-hidden="true"></i>
                            </span>
                                </div>
                                <button class="save_btn">register now</button>
                                <p>Already Have An Account? <a href="{{ url('login') }}">login here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
@endsection