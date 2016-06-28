<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li @yield('current_rec_home')><a href="{{route('receptionistHome')}}">Home</a></li>
        <li class="dropdown @yield('current_services')">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Management <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{URL::route('dutyDays.index')}}">Doctor Schedules</a></li>
            </ul>
        </li>
        <li class="dropdown @yield('current_services')">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Patients <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('appointments.index')}}">Appointments</a></li>
                <li><a href="{{route('patients.index')}}">Patients</a></li>
                <li><a href="{{URL::route('prescriptions.index')}}">All Prescriptions</a></li>
                {{--<li><a href="{{URL::route('printPrescription')}}">Print Prescription</a></li>--}}
                {{--<li><a href="{{route('vital_signs.index')}}">Vital Signs</a></li>--}}
                {{--<li><a href="{{URL::route('appPrescription')}}">Add Prescriptions</a></li>--}}

                {{--<li><a href="/app_proc">Add Procedures</a></li>--}}
                {{--<li><a href="/app_tests">Test Reports</a></li>--}}
                {{--<li><a href="/app_test_print">Print Reports</a></li>--}}
            </ul>
        </li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div><!--/.nav-collapse -->
