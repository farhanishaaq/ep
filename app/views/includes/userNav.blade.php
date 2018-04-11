
<div id="navbar" class="navbar-collapse collapse">

   <ul class="nav navbar-nav navbar-right">
       <li>
           <ul class="nav navbar-nav navbar-right">
               <li @yield('current_home')><a href="{{URL('/')}}">Home</a></li>
               <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Blog<span class="caret"></span></a>
               <ul class="dropdown-menu">
               <li @yield('current_articles')><a href="{{URL::route('articlesList')}}">Articles</a></li>
               <li class="divider"></li>
               <li><a href="{{URL::route('medicineSearch')}}">Medicines</a></li>
               <li class="divider"></li>
               <li @yield('viewPublicHistory')><a href="{{URL::route('viewPublicHistory')}}">Questions</a></li>
                </ul></li>


               <li @yield('current_services')><a href="{{URL::route('services')}}">Services</a></li>
               <li @yield('current_about')><a href="{{URL::route('about')}}">About</a></li>
               <li @yield('current_contacts')><a href="{{URL::route('contacts')}}">Contacts</a></li>

           </ul>

       </li>

        <li>

            @include('includes.profileNavDropdown')


        </li>

   </ul>

</div><!--/.nav-collapse -->

