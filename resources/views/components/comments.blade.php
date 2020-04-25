
                        
                        <!----Right Queue---->
                        <div class="jp_queue_wrapper">
                            <span class="que_text" id="myPlaylistQueue"><i class="fa fa-angle-up" aria-hidden="true"></i> Comments</span>
                            <div id="playlist-wrapp" class="jp-playlist">
							<div class="jp_queue_cls"><i class="fa fa-times" aria-hidden="true"></i></div>
                                <h2>{{ $playlist->title }} comments:</h2>
								<div class="jp_queue_list_inner">
									<ul>

                                        @if( count($comments) == 0 )
                                        <li>
                                            <div>
                                                <a href="javascript:;" class="jp-playlist-item-remove" style="display: none;">×</a> 
                                                <a href="javascript:;" class="jp-playlist-item" tabindex="0">  
                                                    <div class="que_data">
                                                        <span class="jp-artist">[Looks like there's no comments. Be the first!]</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        @endif

                                        @foreach( $comments as $comment )
                                        <li>
                                            @if( $comment->parent_id == null )
                                            <div>
                                                 <a href="javascript:;" class="jp-playlist-item-remove" style="display: none;">×</a> 
                                                <a href="javascript:;" class="jp-playlist-item" tabindex="0">

                                                    <!-- user avatar -->
                                                    <!-- <span class="que_img">
                                                        <img src="images/weekly/song9.jpg">
                                                    </span> -->
 
                                                        
                                                        
                                                    <div class="que_data">{{ $comment->user->nickname }}
                                                        <span class="jp-artist">{{ $comment->message }} [{{ $comment->created_at }}]
                                                        </span>
                                                    </div>
                                                </a>

                                                
                                            <div class="action">
                                                <span class="que_more"><img src="{{ asset('images/svg/more.svg') }}"></span>
                                            </div> 

                                            </div>
                                            <ul class="more_option">
                                                <li class="">
                                                    <a id="{{$comment->id}}" onclick="
                                                    document.getElementById('reply').hidden = false;
                                                    document.getElementById('cancelReply').hidden = false;
                                                    document.getElementById('comment').hidden = true;
                                                    document.getElementById('idInput').value = this.id" 
                                                      href="#message"><span class="opt_icon" >Reply</span></a>
                                                </li>
                                                @if( ($user->id == $playlist->user_id) || ($user->id == $comment->user_id) )
                                                <li class="">
                                                    <a href='{{ url( "commentdeleted/{$comment->id}" ) }}'>Delete</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>

                                        @foreach( $comment->has('childrens')->get() as $children )
                                        @if( $children->parent_id == $comment->id )
                                        <li>
                                            <div>
                                                 <a href="javascript:;" class="jp-playlist-item-remove" style="display: none;">×</a> 
                                                <a href="javascript:;" class="jp-playlist-item" tabindex="0">

                                                    <!-- user avatar -->
                                                    <!-- <span class="que_img">
                                                        <img src="images/weekly/song9.jpg">
                                                    </span> -->
 
                                                        
                                                        
                                                    <div class="que_data">Reply to: {{ $comment->user->nickname }}  from: {{ $children->user->nickname }}
                                                        <span class="jp-artist">{{ $children->message }} [{{ $children->created_at }}]
                                                        </span>
                                                    </div>
                                                </a>
                                                @if( ($user->id == $playlist->user_id) || ($user->id == $children->user_id) )
                                                <div class="action">
                                                    <span class="que_more"><img src="{{ asset('images/svg/more.svg') }}"></span>
                                                </div> 

                                                <ul class="more_option">
                                                    
                                                    <li class="">
                                                        <a href='{{ url("commentdeleted/{$children->id}") }}'>Delete</a>
                                                    </li>
                                                    
                                                </ul>
                                                @endif
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                        

                                        @endif
                                        @endforeach
									</ul>
								</div>
                            <form  method="Post" action='{{ url( "playlistcommented/{$playlist->id}" ) }}'>
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="message" name="message" placeholder="Enter your comment" class="form-control">
                                    <input type="text" id="idInput" name="parent_id" hidden="true">
                                </div>
                                <button id="comment" class="save_btn">Send</button>
                                <button id="reply" class="save_btn " hidden="true" 
                                formaction='{{ url( "commentreplied/{$playlist->id}" ) }}'>Send reply</button>
                                
                            </form>
                            <button onclick="document.getElementById('reply').hidden = true;
                                            document.getElementById('cancelReply').hidden = true;
                                            document.getElementById('comment').hidden = false;" 
                                            id="cancelReply" class="save_btn" hidden="true">Cancel</button>
                            </div>
                        </div>
           