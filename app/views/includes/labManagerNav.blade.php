<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li @yield('current_lab_home')><a href="/labmanager_home">Home</a></li>
        <li @yield('current_services')><a href="/app_tests?flag=results">Test Results</a></li>
        <li @yield('current_about')><a href="/app_test_print">Test Reports</a></li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div><!--/.nav-collapse -->