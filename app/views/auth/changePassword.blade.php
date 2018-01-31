@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Change Password
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_login")
    class="current"
@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Change Password</div>
    </div>
@stop


@section('sliderContent')
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <br>
    <section id="content">
        <div class="login">
            <div class="login-card login-page h400">

                <form action="{{route('changePassword')}}" method="post" name="form" onsubmit="return checkPasswordError()">
                <h6 style="color: grey;">Please change your password below.</h6>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="password" name="oldPassword" id="oldPassword" class="input-block-level" placeholder="Old Password" onblur="checkOldPassword(this.id)" required>
                    <span id="status_oldPassword"></span>
                    <input type="password" name="newPassword" id="newPassword" class="input-block-level" placeholder="New Password" required onblur="checkConfirmPassword(this.id)">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="input-block-level" placeholder="Confirm New Password" onblur="checkConfirmPassword(this.id)" required>
                    <span id="status_confirmPassword"></span>
                    @if(!empty($response))
                        @if($response == "Success")
                            <span id="success" style="color: green" class="pull-right">Password Update Successfully</span><br><br>
                        @endif
                    @endif

                    <input type="submit" class="btn btn-raised btn-sm btn-1"  value="Confirm" id="submitButton" >

                </form>



            </div>
        </div>
        <br><br><br>
        <br><br><br>
        <br><br><br><br>
        <br><br><br><br><br><br>
    </section>
    <script src="{{asset('js/emailAvailability.js')}}"></script>
@stop