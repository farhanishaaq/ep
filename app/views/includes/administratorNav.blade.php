<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_admin_home')><a href="{{URL::route('adminHome')}}">Home</a></li>
        <li @yield('current_services')><a style="cursor: pointer">Management</a>
            <ul>
                <li> <a href="{{URL::route('employees.index')}}">Manage Employees</a></li>
                <li><a href="{{URL::route('dutydays.index')}}">Doctor Schedules</a></li>
                <li><a href="{{URL::route('medicines.index')}}">Manage Medicines</a></li>
            </ul>
        </li>
        <li @yield('current_about')><a style="cursor: pointer">Patients</a>
            <ul>
                <li><a href="{{URL::route('appointments.index')}}">Appointments</a></li>
                <li><a href="{{URL::route('patients.index')}}">Patients</a></li>
                <li><a href="{{URL::route('searchPmr')}}">Medical Records</a></li>
                <li><a href="{{URL::route('vitalSign')}}">Vital Signs</a></li>
                <li><a href="{{URL::route('appPrescription')}}">Add Prescriptions</a></li>
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
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</nav>