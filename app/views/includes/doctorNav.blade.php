<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_doc_home')><a href="{{URL::route('doctorHome')}}">Home</a></li>
        {{--<li @yield('current_services')><a href="{{URL::route('searchPmr')}}">Medical Records</a></li>--}}
        <li @yield('current_services')><a href="{{URL::route('patients.index')}}">Medical Records</a></li>
        <li @yield('current_about')><a href="{{URL::route('vitalSign')}}">Vital Signs</a></li>
        <li @yield('current_contacts')><a href="{{URL::route('appointments.index')}}">Appointments</a></li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</nav>