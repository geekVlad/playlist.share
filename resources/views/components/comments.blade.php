<!----Audio Player Section---->
                        
                        <!----Right Queue---->
                        <div class="jp_queue_wrapper">
                            <span class="que_text" id="myPlaylistQueue"><i class="fa fa-angle-up" aria-hidden="true"></i> Comments</span>
                            <div id="playlist-wrap" class="jp-playlist">
							<div class="jp_queue_cls"><i class="fa fa-times" aria-hidden="true"></i></div>
                                <h2>{{ $playlist->title }} comments:</h2>
								<div class="jp_queue_list_inner">
									<ul>
										<li>&nbsp;</li>
									</ul>
								</div>
                                <div class="jp_queue_btn">
                                    <a href="javascript:;" class="ms_clear" data-toggle="modal" data-target="#clear_modal">clear</a>
                                    <a href="clear_modal.html" class="ms_save" data-toggle="modal" data-target="#save_modal">save</a>
                                </div>
                            </div>
                        </div>
           