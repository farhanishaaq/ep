<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        {{--<li @yield('current_admin_home')><a href="{{URL::route('adminHome')}}">Dashboard</a></li>--}}
        <li @yield('current_admin_home')><a href="{{URL::route('showDashboard')}}">Dashboard</a></li>

        {{-- Manage Clinic --}}
        <li class="dropdown @yield('current_services')">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Clinic<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{URL::route('doctors.index')}}">Manage Doctors</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('appointments.index')}}">Manage Appointments</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('patients.index')}}">Manage Patients</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('prescriptions.index')}}">Manage Prescriptions</a></li>
            </ul>
        </li>

        {{-- Inventory --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Inventory <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('medicinePurchase.index')}}">Medicine Purchases</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('users.index')}}">Manage Users</a></li>
                {{--<li class="divider"></li>
                <li><a href="{{URL::route('dutyDays.index')}}">Doctor Schedules</a></li>--}}
                <li class="divider"></li>
                <li><a href="{{URL::route('medicines.index')}}">Manage Medicines</a></li>
            </ul>
        </li>

        {{-- Administrations --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('roles.index')}}">Manage Roles</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('users.index')}}">Manage Users</a></li>
                {{--<li class="divider"></li>
                <li><a href="{{URL::route('dutyDays.index')}}">Doctor Schedules</a></li>--}}
                <li class="divider"></li>
                <li><a href="{{URL::route('medicines.index')}}">Manage Medicines</a></li>
            </ul>
        </li>
        @include('includes.profileNavDropdown')
    </ul>
</div><!--/.nav-collapse -->