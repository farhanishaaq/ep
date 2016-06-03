@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Login
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_login")
class="current"
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Welcome to login</div>
</div>
@stop


@section('sliderContent')
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <section id="content">
		<div class="login">
			<div class="login-card login-page">
				@if(count($errors))
				    <div class="col-md-12">
                    <ul class="error-container m10">
                        <li>Solve Following Errors!</li>
                        <li>
                            <ul>
                                @foreach($errors->all("<li>:message</li>") as $message)
                                    {{ $message }}
                                @endforeach
                            </ul>
                        </li>
                    </ul>
				    </div>

                @endif
				{{ Form::open(array('url' => 'doLogin')) }}
                    <input type="email" id = "email" name="email" placeholder="Email" required="true">
                    <input type="password" required="true" name="password" id="password" placeholder="Password">
                    <input style="width:100%" type="submit" name="login" class="login login-submit" value="login">
				{{ Form::close() }}

				{{--</form>--}}

				<div class="login-help">
				<a href="{{URL::route('remind')}}">Forgot Password</a>
				</div>
			</div>
		</div>
		<br><br><br>
		<br><br><br><br>
		<br><br><br><br>
    </section>
@stop