<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_rec_home')><a href="{{route('receptionistHome')}}">Home</a></li>
        <li @yield('current_services')><a style="cursor: pointer">Management</a>
            <ul>
                <li><a href="{{URL::route('dutydays.index')}}">Doctor Schedules</a></li>
            </ul>
        </li>
        <li @yield('current_about')><a style="cursor: pointer">Patients</a>
            <ul>
                <li><a href="{{route('appointments.index')}}">Appointments</a></li>
                <li><a href="{{route('patients.index')}}">Patients</a></li>
                <li><a href="{{route('searchPmr')}}">Medical Records</a></li>
                {{--<li><a href="{{route('vitalsigns.index')}}">Vital Signs</a></li>--}}
                {{--<li><a href="{{URL::route('appPrescription')}}">Add Prescriptions</a></li>--}}
                {{--<li><a href="/app_pres_print">Print Prescription</a></li>--}}
                {{--<li><a href="/app_proc">Add Procedures</a></li>--}}
                {{--<li><a href="/app_tests">Test Reports</a></li>--}}
                {{--<li><a href="/app_test_print">Print Reports</a></li>--}}
            </ul>
        </li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</nav>