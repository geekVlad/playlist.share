
            <div class="ms_header">
                <div class="ms_top_left">
                    <div class="ms_top_search">
                        <input type="text" class="form-control" placeholder="Search Music Here..">
                        <span class="search_icon">
                            <img src="images/svg/search.svg" alt="">
                        </span>
                    </div>
                    <div class="ms_top_trend">
                        <span><a href="#"  class="ms_color">Trending Songs :</a></span> <span class="top_marquee"><a href="#">Dream your moments, Until I Met You, Gimme Some Courage, Dark Alley (+8 More)</a></span>
                    </div>
                </div>
                <div class="ms_top_right">
                    <div class="ms_top_lang">
                        <span data-toggle="modal" data-target="#lang_modal">languages <img src="images/svg/lang.svg" alt=""></span>
                    </div>
                    <div class="ms_top_btn">
                        <a href="upload.html" class="ms_btn">upload</a>
                        <a href="javascript:;" class="ms_admin_name">Hello 
                    <span class="ms_pro_name">ns</span>                                                    
                        </a>
                        <ul class="pro_dropdown_menu">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="manage_acc.html" target="_blank">Pricing Plan</a></li>
                            <li><a href="blog.html" target="_blank">Blog</a></li>
                            <li><a href="#">Setting</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </li>

                                        
                        </ul>
                    </div>
                </div>
            </div>