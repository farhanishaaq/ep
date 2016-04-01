

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
            <div class="grid_12">
                <p class="info text_4 color_4">
                    © <span id="copyright-year"></span> | <a href="#">Easy Physicians</a> <br/>
                    Website designed by <a href="http://faboloustech.com/" rel="nofollow">Fabulous Technologies</a>
                </p>
            </div>
        </div>
    </div>
</footer>