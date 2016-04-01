<nav class="nav put-right">
    <ul class="sf-menu">
        <li @yield('current_doc_home')><a href="/doctor_home">Home</a></li>
        <li @yield('current_services')><a href="/search_pmr">Medical Records</a></li>
        <li @yield('current_about')><a href="/app_vitals">Vital Signs</a></li>
        <li @yield('current_contacts')><a href="/appointments">Appointments</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</nav>