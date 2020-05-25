
            <div class="ms_header">
                <div class="ms_top_left">
                    <div class="ms_top_search">
                        <form id="search-form" action="{{ url('search') }}" method="POST">
                            @csrf
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ old('search') }}">
                            <a href="javascript:;" onclick="document.getElementById('search-form').submit()">
                                <span class="search_icon">
                                    <img src="{{ asset('images/svg/search.svg') }}" alt="">
                                </span>
                            </a>

                        </form>
                    </div>
                    <div class="ms_top_trend">
                        <span><a href="#"  class="ms_color">Trending Songs :</a></span> <span class="top_marquee"><a href="#">Dream your moments, Until I Met You, Gimme Some Courage, Dark Alley (+8 More)</a></span>
                    </div>
                </div>
                <div class="ms_top_right">
                    <div class="ms_top_btn">
                        <!-- <a href="javascript:;" class="ms_admin_name">Hello 
                    <span class="ms_pro_name">ns</span>                                                    
                        </a> -->
                        <a class="ms_pro_name" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                        </form>
                        <!-- <ul class="pro_dropdown_menu">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="manage_acc.html" target="_blank">Pricing Plan</a></li>
                            <li><a href="blog.html" target="_blank">Blog</a></li>
                            <li><a href="#">Setting</a></li>
                            <li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </li>

                                        
                        </ul> -->
                    </div>
                </div>
            </div>