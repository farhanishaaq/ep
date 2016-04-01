    <header id="header">
                <div id="stuck_container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 h66">
                                <div class="brand put-left">
                                    <h1 class="mT0 mB0">
                                        <a href="/">
                                            <img src="{{asset('images/logo_new1.jpg')}}" alt="Logo"/>
                                        </a>
                                    </h1>
                                </div>
                                @if(Auth::user())
                                    @if(Auth::user()->role == 'Administrator')
                                        @include('includes.administratorNav')
                                    @elseif(Auth::user()->role == "Accountant")
                                        @include('includes.accountantNav')
                                    @elseif(Auth::user()->role=='Doctor')
                                        @include('includes.doctorNav')
                                    @elseif(Auth::user()->role=='Lab Manager')
                                        @include('includes.labManagerNav')
                                    @elseif(Auth::user()->role=='Receptionist')
                                        @include('includes.receptionistNav')
                                    @elseif(Auth::user()->role=='Super User')
                                        @include('includes.superUserNav')
                                    @endif
                                @else
                                    @include('includes.webNav')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </header>