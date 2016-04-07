<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_super_home')><a href="{{URL::route('superHome')}}">Home</a></li>
        <li><a href="/clinics">Manage Clinics</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</nav>