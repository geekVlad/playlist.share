@extends('layouts.app')

@section('content')
    <div class="ms_save_modal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <h1>Log in to start sharing your music!</h1>
                        <div class="save_modal_btn">
                            <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i> continue with google </a>
                            <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i> continue with facebook</a>
                        </div>
                         <form method="POST" action="/login">
                            @csrf
                            <div class="ms_save_email">
                                <h3>or use your email</h3>
                                <div class="save_input_group">
                                    <input name="identity" type="text" placeholder="Enter Your Nickname or Email" class="form-control">
                                </div>
                                <div class="save_input_group">
                                    <input name="password" type="password" placeholder="Enter Password" class="form-control">
                                </div>
                                <button class="save_btn">Log in</button>
                            </div>
                        </form>
                        <div class="ms_dnt_have">
                            <span>Dont't have an account ?</span>
                            <a href="/register">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>      

@endsection