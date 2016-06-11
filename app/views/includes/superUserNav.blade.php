<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li @yield('current_super_home')><a href="{{URL::route('superHome')}}">Home</a></li>
        <li><a href="/clinics">Manage Clinics</a></li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div><!--/.nav-collapse -->