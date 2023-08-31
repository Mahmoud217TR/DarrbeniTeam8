    <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
        <span class="sr-only">Toggle sidebar</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>
    </button>

    <!-- /section:basics/sidebar.mobile.toggle -->
    <div class="navbar-header pull-left">
        <!-- #section:basics/navbar.layout.brand -->
        {{-- <img src="{{ asset('frontend/assets/images/Logo-2.png') }}" alt="Company Logo"> --}}


        <!-- /section:basics/navbar.layout.brand -->

        <!-- #section:basics/navbar.toggle -->

        <!-- /section:basics/navbar.toggle -->
    </div>
    

    <!-- #section:basics/navbar.dropdown -->
    <div class="navbar-buttons navbar-header pull-right" role="navigation">
        <ul class="nav ace-nav">
            <li class="nav-item dropdown">
               
                
            </li>
        </ul>
    </div>
    <div class="navbar-buttons navbar-header pull-right" role="navigation">

        <ul class="nav ace-nav">





            <!-- #section:basics/navbar.user_menu -->
            <li class="light-blue">
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <img class="nav-user-photo" src="{{ asset('dashboard/assets/images/avatar2.png') }}"
                        alt="" />
                    <span class="user-info">
                        <small>hello</small>

                        {{ Auth::user()->name ?? '' }}
                    </span>

                    <i class="ace-icon fa fa-caret-down"></i>
                </a>

                <ul class="user-menu dropdown-menu dropdown-menu dropdown-light-blue dropdown-caret dropdown-close ">




                    {{-- <li>
                            <a href="profile.html">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>
                        <li class="divider"></li>

                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li> --}}
                    <li>

                        {{-- <div>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div> --}}
                    </li>

                </ul>
            </li>
        </ul>
    </div>


    <!-- end col -->

    <!-- /section:basics/navbar.dropdown -->
