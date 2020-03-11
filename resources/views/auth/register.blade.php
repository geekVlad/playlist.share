@extends('layouts.app')

@section('content')
<div class="ms_register_popup">
            <div class="modal-dialog register_dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="ms_register_img">
                            <img src="images/register_img.png" alt="" class="img-fluid" />
                        </div>
                        <form method="POST" action="/register">
                        @csrf
                            <div class="ms_register_form">
                                <h2>Register / Sign Up</h2>
                                <div class="form-group">
                                    <input name="name" type="text" placeholder="Enter Your Name" class="form-control">
                                    <span class="form_icon">
    							<i class="fa_icon form-user" aria-hidden="true"></i>
    							</span>
                                </div>
                                <div class="form-group">
                                    <input name="email" type="text" placeholder="Enter Your Email" class="form-control">
                                    <span class="form_icon">
    							<i class="fa_icon form-envelope" aria-hidden="true"></i>
    						</span>
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" placeholder="Enter Password" class="form-control">
                                    <span class="form_icon">
    						<i class="fa_icon form-lock" aria-hidden="true"></i>
    						</span>
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" placeholder="Confirm Password" class="form-control">
                                    <span class="form_icon">
    						<i class=" fa_icon form-lock" aria-hidden="true"></i>
    						</span>
                                </div>
                                <button class="save_btn">register now</button>
                                <p>Already Have An Account? <a href="#myModal1" data-toggle="modal" class="ms_modal hideCurrentModel">login here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
@endsection