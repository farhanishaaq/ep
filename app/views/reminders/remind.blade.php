@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Forgot Password
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->


@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Password Recovery Form</div>
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
                <div class="login-card">
                @if(Session::has('error'))
                    <ul class="error-container">
                        <li>Solve Following Errors!</li>
                        <li>
                            <ul>
                                <li>{{Session::get('error')}}</li>
                            </ul>
                        </li>
                    </ul>
                @elseif(Session::has('status'))
                    <p class='success'>  </p>
                    <ul class="success-container">
                        <li>{{Session::get('status')}}</li>
                    </ul>
                @endif
                {{ Form::open(array('action' => 'RemindersController@postRemind', 'method' => 'POST')) }}
                    <input type="email" required="true" id = "email" name="email" placeholder="Email" required="true">

                    <input style="width:100%" type="submit" name="login" class="login login-submit" value="Send Reset Link">
                {{ Form::close() }}
                </div>
            </div>
            <br><br><br>
            <br><br><br><br>
		</section>
@stop