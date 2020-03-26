
                        
                        <!----Right Queue---->
                        <div class="jp_queue_wrapper">
                            <span class="que_text" id="myPlaylistQueue"><i class="fa fa-angle-up" aria-hidden="true"></i> Comments</span>
                            <div id="playlist-wrap" class="jp-playlist">
							<div class="jp_queue_cls"><i class="fa fa-times" aria-hidden="true"></i></div>
                                <h2>{{ $playlist->title }} comments:</h2>
								<div class="jp_queue_list_inner">
									<ul>

                                        @foreach( $comments as $comment )
                                        <li>
                                            <div>
                                                 <a href="javascript:;" class="jp-playlist-item-remove" style="display: none;">×</a> 
                                                <a href="javascript:;" class="jp-playlist-item" tabindex="0">

                                                    <!-- user avatar -->
                                                    <!-- <span class="que_img">
                                                        <img src="images/weekly/song9.jpg">
                                                    </span> -->

                                                    <div class="que_data">{{ $comment->user->nickname }}<span class="jp-artist">{{ $comment->message }} </span>
                                                    </div>
                                                </a>

                                                
                                                <div class="action">
                                                    <span class="que_more"><img src="images/svg/more.svg"></span>
                                                </div> 

                                            </div>
                                            <ul class="more_option">
                                                <li class="">
                                                    <a href="#message"><span class="opt_icon" >Reply</span></a>
                                                </li>
                                                
                                            </ul>
                                        </li>
                                        @endforeach
									</ul>
								</div>
                            <form method="Post" action="playlistcommented?id={{$playlist->id}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="message" name="message" placeholder="Enter your comment" class="form-control">
                                </div>
                                <button class="save_btn">Send</button>
                            </form>
                            </div>
                        </div>
           