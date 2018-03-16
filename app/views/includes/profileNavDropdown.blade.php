{{-- Profile --}}
&nbsp;&nbsp;&nbsp;<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{asset('images/profile-dumy.png')}}" width="50px"> <span class="caret"></span></a>
    <ul class="dropdown-menu">
        {{--<li><a href="#">Welcome, {{Auth::user()->fname . ' '. Auth::user()->lname}}</a></li>--}}
        <li><a href="#">Welcome, {{Auth::user()->full_name}}</a></li>
        <li><a href="#"><img src="
                             @if(empty(Auth::user()->photo))
                             {{asset('images/profile-dumy.png')}}
                             @else
                                     {{asset(Auth::user()->photo)}}
                @endif
                             " width="100px"> </a></li>
        <li class="divider"></li>

        @if(Auth::user()->user_type == \App\Globals\GlobalsConst::PORTAL_DOCTOR)
        <li><a href="{{route('drDutyDays')}}">My Duty Days</a></li>
        <li class="divider"></li>
        @elseif(Auth::user()->user_type == \App\Globals\GlobalsConst::DOCTOR)
        <li><a href="{{route('drDutyDays')}}">My Duty Days</a></li>
                <li class="divider"></li>
        @endif

        <li><a href="{{route('showChangePassword')}}">Change Password</a></li>
        <li class="divider"></li>
        <li><a href="{{route('userProfile')}}">Profile</a></li>
        <li class="divider"></li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</li>