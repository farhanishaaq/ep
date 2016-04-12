<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_rec_home')><a href="/receptionist_home">Home</a></li>
        <li @yield('current_services')><a style="cursor: pointer">Management</a>
            <ul>
                <li><a href="/dutydays">Doctor Schedules</a></li>
            </ul>
        </li>
        <li @yield('current_about')><a style="cursor: pointer">Patients</a>
            <ul>
                <li><a href="/appointments">Appointments</a></li>
                <li><a href="/patients">Patients</a></li>
                <li><a href="/search_pmr">Medical Records</a></li>
                <li><a href="/app_vitals">Vital Signs</a></li>
                <li><a href="/app_prescription">Add Prescriptions</a></li>
                <li><a href="/app_pres_print">Print Prescription</a></li>
                {{--<li><a href="/app_proc">Add Procedures</a></li>--}}
                <li><a href="/app_tests">Test Reports</a></li>
                <li><a href="/app_test_print">Print Reports</a></li>
            </ul>
        </li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</nav>