 
  <!-- ========== Left Sidebar Start ========== -->
   <div class="left side-menu">
        <div class="admin-person media-screen" id="admin-person">
                <div class="person">
                     <div class="person-images">
                        @if(auth()->user()->photo == 'photo')
                         <div class="main-img" style="background: url({{ asset('images/avatar-1.jpg') }});">
                        @else
                        <div class="main-img" style="background: url({{ asset('uploads/avaters/'.auth()->user()->photo) }});"> 
                        @endif
                         </div>
                     </div>
                     <div class="online">
                            <i class="fas fa-circle"></i> <span>online</span>
                     </div>
                </div>
                <div class="person-name">
                    Welcome,  <a href="{{ route('admins.show',auth()->user()->id) }}">{{ auth()->user()->user_name }}</a>
                 </div>
            </div>
        <div class="sidebar-inner slimscrollleft">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>
                    <li class="text-muted menu-title">Navigation</li>

                    <li class="has_sub">
                        <a href="{{ route('dashboard') }}" class="waves-effect"><span class="label label-pill label-primary float-right">1</span><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> </a>
                    </li>
                    <li class="has_sub">
                        
                    </li>
                    @permission('index-generals')
                    <li class="has_sub {{ Nav::isResource('generals') }}">
                       <a href="{{ route('generals.index') }}" class="waves-effect"><i class="fas fa-wrench"></i><span> General Setting </span> </a>
                    </li>
                    @endpermission
                    @permission('index-portfolios') 
                     <li class="has_sub {{ Nav::hasSegment(['portfolios','sub-portfolios'],2,'is-active') }}">
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-album"></i> <span> portfolios </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li>
                             <a href="{{ route('portfolios.index') }}" class="waves-effect "> <span> Category </span> </a>
                            </li>
                            <li class="{{ Nav::hasSegment('sub-portfolios',2,'is-active') }}">
                              <a href="{{ route('sub_portfolios.index') }}" class="waves-effect {{ Nav::hasSegment('sub-portfolios',2,'is-active') }}"> <span> Portfolio </span> </a>
                            </li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('index-roles')
                    <li class="has_sub {{ Nav::isResource('roles') }}">
                        <a href="{{ route('roles.index') }}" class="waves-effect"><i class="fas fa-toilet-paper"></i><span> roles </span> </a>
                    </li>
                    @endpermission
                    @role('developer') 
                            @permission('index-permissions')
                            <li class="has_sub {{ Nav::isResource('permissions') }}">
                                <a href="{{ route('permissions.index') }}" class="waves-effect"><i class="fas fa-drum"></i><span> permissions </span> </a>
                            </li>
                            @endpermission 
                    @endrole
                     @permission('index-admins')
                    <li class="has_sub {{ Nav::isResource('admins') }}">
                        <a href="{{ route('admins.index') }}" class="waves-effect"><i class="fas fa-user-secret"></i><span> Admins </span> </a>
                    </li>
                    @endpermission
                    <li class="has_sub" >
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-album"></i> <span> Components </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="components-grid.html">Grid</a></li>
                            <li><a href="components-grid.html">Grid</a></li>
                            <li><a href="components-grid.html">Grid</a></li>
                            <li><a href="components-grid.html">Grid</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->
