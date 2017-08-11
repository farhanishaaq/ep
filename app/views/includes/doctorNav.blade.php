<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li @yield('current_doc_home')><a href="{{URL::route('doctorHome')}}">Home</a></li>
        {{--<li @yield('current_services')><a href="{{URL::route('searchPmr')}}">Medical Records</a></li>--}}
        <li @yield('current_services')><a href="{{URL::route('patients.index')}}">Medical Records</a></li>
        <li @yield('current_about')><a href="{{URL::route('vitalSign')}}">Vital Signs</a></li>
        <li @yield('current_contacts')><a href="{{URL::route('appointments.index')}}">Appointments</a></li>
        <li @yield('current_contacts')><a href="{{URL::route('dutyDays.index')}}">Duty Days</a></li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div><!--/.nav-collapse -->