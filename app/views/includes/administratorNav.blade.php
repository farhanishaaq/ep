<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_admin_home')><a href="{{URL::route('adminHome')}}">Home</a></li>
        <li @yield('current_services')><a style="cursor: pointer">Management</a>
            <ul>
                <li> <a href="/employees">Manage Employees</a></li>
                <li><a href="/dutydays">Doctor Schedules</a></li>
                <li><a href="/medicines">Manage Medicines</a></li>
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
        <li @yield('current_contacts')><a style="cursor: pointer">Billing</a>
            <ul>
                <li><a href="/app_check_fee">Add Checkup Fee</a></li>
                <li><a href="/app_checkup_fee_print">Checkup Fee Invoice</a></li>
                <li><a href="/app_test_fee">Add Test Fee</a></li>
                <li><a href="/app_test_fee_print">Test Fee Invoice</a></li>
            </ul>
        </li>
        <li @yield('current_reporting')><a style="cursor: pointer">Reporting</a>
            <ul>
                <li> <a href="/patients_reporting">Checked Patients</a></li>
            </ul>
        </li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</nav>