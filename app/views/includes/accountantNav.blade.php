<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li @yield('current_acc_home')><a href="/accountant_home">Home</a></li>
        <li class="dropdown @yield('current_services')">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Billing <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="/app_check_fee">Add Checkup Fee</a></li>
                <li><a href="/app_test_fee">Add Test Fee</a></li>
            </ul>
        </li>
        <li class="dropdown @yield('current_services')">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Invoicing <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="/app_checkup_fee_print">Checkup Fee Invoice</a></li>
                <li><a href="/app_test_fee_print">Test Fee Invoice</a></li>
            </ul>
        </li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div><!--/.nav-collapse -->