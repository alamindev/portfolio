<!-- Top Bar Start -->
<div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="{{ route('dashboard') }}" class="logo">
                <i class="zmdi zmdi-group-work icon-c-logo"></i>
                <span>Admin</span></a>
        </div>

        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">

                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link waves-effect waves-light right-bar-toggle" href="javascript:void(0);">
                        <i class="zmdi zmdi-format-subject noti-icon"></i>
                    </a>
                </li>

                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                       @if(auth()->user()->photo == 'photo')
                       <img src="{{ asset('images/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                      @else
                      <img src="{{ asset('uploads/avaters/'.auth()->user()->photo) }}" alt="user" class="rounded-circle"> 
                      @endif
                     
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="text-overflow"><small>{{ auth()->user()->user_name }}</small> </h5>
                        </div> 
                        <!-- item-->
                        <a href="{{ route('admins.show',auth()->user()->id) }}" class="dropdown-item notify-item">
                            <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                        </a> 
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                        </a>  
                        <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item">
                            <i class="zmdi zmdi-power"></i> <span>Logout</span>
                        </a> 
                    </div>
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="zmdi zmdi-menu"></i>
                    </button>
                </li>
            </ul>

        </nav>

    </div>
    <!-- Top Bar End -->
