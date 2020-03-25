
                        
                        <!----Right Queue---->
                        <div class="jp_queue_wrapper">
                            <span class="que_text" id="myPlaylistQueue"><i class="fa fa-angle-up" aria-hidden="true"></i> Comments</span>
                            <div id="playlist-wrap" class="jp-playlist">
							<div class="jp_queue_cls"><i class="fa fa-times" aria-hidden="true"></i></div>
                                <h2>{{ $playlist->title }} comments:</h2>
								<div class="jp_queue_list_inner">
									<ul>
                                        @foreach( $comments as $comment )
										<li>{{ $comment->message }}</li>
                                        @endforeach
									</ul>
								</div>
                                <div class="jp_queue_btn">
                                    <a href="javascript:;" class="ms_clear" data-toggle="modal" data-target="#clear_modal">clear</a>
                                    <a href="clear_modal.html" class="ms_save" data-toggle="modal" data-target="#myModal1">Leave comments</a>
                                </div>
                            </div>
                        </div>

        <div id="myModal1" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog login_dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fa_icon form_close"></i>
                    </button>
                    <div class="modal-body">
                        <div class="ms_register_img">
                            <img src="images/register_img.png" alt="" class="img-fluid" />
                        </div>
                        <div class="ms_register_form">
                            <h2>login / Sign in</h2>
                            <div class="form-group">
                                <input type="text" placeholder="Enter Your Email" class="form-control">
                                <span class="form_icon">
                            <i class="fa_icon form-envelope" aria-hidden="true"></i>
                        </span>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Enter Password" class="form-control">
                                <span class="form_icon">
                        <i class="fa_icon form-lock" aria-hidden="true"></i>
                        </span>
                            </div>
                            <div class="remember_checkbox">
                                <label>Keep me signed in
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                            </div>
                            <a href="profile.html" class="ms_btn" target="_blank">login now</a>
                            <div class="popup_forgot">
                                <a href="#">Forgot Password ?</a>
                            </div>
                            <p>Don't Have An Account? <a href="#myModal" data-toggle="modal" class="ms_modal1 hideCurrentModel">register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           