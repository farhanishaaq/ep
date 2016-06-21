<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li class="@yield('current_super_home')" ><a href="{{URL::route('showDashboard')}}">Home</a></li>
        {{-- Administrations --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Companies</a></li>
                <li class="divider"></li>
                <li><a href="#">Business Units</a></li>
                <li class="divider"></li>
                <li><a href="#">Roles</a></li>
                <li class="divider"></li>
                <li><a href="#">Users</a></li>
            </ul>
        </li>
        @include('includes.profileNavDropdown')
    </ul>
</div><!--/.nav-collapse -->
