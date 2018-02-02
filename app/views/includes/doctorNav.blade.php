<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li @yield('current_doc_home')><a href="{{URL::route('doctorHome')}}">Home</a></li>
        {{--<li @yield('current_doc_home')><a href="{{URL::route('drEditer')}}">Article</a></li>--}}
        {{--<li @yield('current_services')><a href="{{URL::route('searchPmr')}}">Medical Records</a></li>--}}
        <li @yield('current_services')><a href="{{URL::route('patients.index')}}">Medical Records</a></li>
        <li @yield('current_about')><a href="{{URL::route('vitalSign')}}">Vital Signs</a></li>
        <li @yield('current_contacts')><a href="{{URL::route('appointments.index')}}">Appointments</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">Blog<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{URL::route('articlesList')}}">Articles</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('editer')}}">Write Article</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('question.index')}}">Manage Questions</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::route('questionHistory')}}">Questions History</a></li>
            </ul>
        </li>


        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div><!--/.nav-collapse -->