

  <div class="container">
            {{--<div class="row wrap_9 wrap_4 wrap_10">--}}
              @if(Auth::user())
              @else
                  @include('includes.webSocialLinks')
              @endif

        </div>
    </section>
</div>

<footer id="footer" class="color_9">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="p15 text_4 color_8">
                    <span class="dB fL">Copyright © <span id="copyright-year"></span> <a href="#">Easy Physicians</a>. All rights reserved.</span>
                    <span class="dB fR">Website designed by <a href="http://faboloustech.com/" rel="nofollow">Fabulous Technologies</a></span>
                </p>
            </div>
        </div>
    </div>
</footer>