<nav class="nav put-right">
    <ul class="sf-menu">

        <li @yield('current_home')><a href="{{URL::route('home')}}">Home</a></li>
        <li @yield('current_login')><a href="{{URL::route('login')}}">Login</a></li>
        <li @yield('current_services')><a href="{{URL::route('services')}}">Services</a></li>
        <li @yield('current_about')><a href="{{URL::route('about')}}">About</a></li>
        <li @yield('current_contacts')><a href="{{URL::route('contacts')}}">Contacts</a></li>
    </ul>
</nav>