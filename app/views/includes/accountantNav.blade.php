<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_acc_home')><a href="/accountant_home">Home</a></li>
        <li @yield('current_services')><a style="cursor: pointer">Billing</a>
            <ul>
                <li><a href="/app_check_fee">Add Checkup Fee</a></li>
                <li><a href="/app_test_fee">Add Test Fee</a></li>
            </ul>
        </li>
        <li @yield('current_about')><a style="cursor: pointer">Invoicing</a>
            <ul>
                <li><a href="/app_checkup_fee_print">Checkup Fee Invoice</a></li>
                <li><a href="/app_test_fee_print">Test Fee Invoice</a></li>
            </ul>
        </li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</nav>