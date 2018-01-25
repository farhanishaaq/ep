{{-- Profile --}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{asset('images/profile-dumy.png')}}" width="50px"> <span class="caret"></span></a>
    <ul class="dropdown-menu">
        {{--<li><a href="#">Welcome, {{Auth::user()->fname . ' '. Auth::user()->lname}}</a></li>--}}
        <li><a href="#">Welcome, {{Auth::user()->full_name}}</a></li>
        <li><a href="#"><img src="{{asset('images/profile-dumy.png')}}" width="100px"> </a></li>
        <li class="divider"></li>
        <li><a href="#">Change Password</a></li>
        <li class="divider"></li>
        <li><a href="{{route('userProfile')}}">Profile</a></li>
        <li class="divider"></li>
        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</li>