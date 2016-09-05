<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li @yield('current_admin_home')><a href="{{URL::route('adminHome')}}">Home</a></li>
        <li class="dropdown @yield('current_services')">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Patients<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{URL::route('patients.index')}}">Patients</a></li>
                <li><a href="{{URL::route('appointments.index')}}">Appointments</a></li>
                <li><a href="{{URL::route('prescriptions.index')}}">All Prescriptions</a></li>
            </ul>
        </li>
        <li class="dropdown @yield('current_services')">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Management <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{URL::route('employees.index')}}">Manage Employees</a></li>
                {{--<li><a href="{{URL::route('dutydays.index')}}">Doctor Schedules</a></li>--}}
                <li><a href="{{URL::route('medicines.index')}}">Manage Medicines</a></li>
            </ul>
        </li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div><!--/.nav-collapse -->