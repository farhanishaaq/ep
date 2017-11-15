
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
@section('headScript')
    {{ HTML::script('js/jquery.typeahead.min.js') }}
    {{ HTML::style('/css/jquery.typeahead.min.css') }}

@stop
        @section('redBar')
            <div class = "user_logo">
                <div class="header_1 wrap_3 color_3 login-bar">Search Doctor</div>
            </div>
        @stop


        @section('sliderContent')
        @stop


        <!--========================================================
                                  CONTENT
        =========================================================-->

        @section('content')
            <div class="container-fluid" style="background-image: url('{{asset('images/index_slide02.jpg')}}') ; height: 400px">

                <div class="col-lg-8 col-lg-offset-2 ">
                    <form class="col-lg-12 form-inline" method="" id="search" action="" style="margin-top: 300px">
                        <div class="col-lg-3 col-md-3 pd0">

                            <select class="js-example-basic-single" id="city">
                                @foreach($cities as $city)
                                        <option value="{{$city['id']}}">{{$city['name']}}</option>
                                    @endforeach
                            </select>

                        </div>
                        <div class="col-lg-7 col-md-7 pd0">
                            <select class="js-example-basic-singlae" id="query">


                            </select>

                            {{--<div class="typeahead__container">--}}
                                {{--<div class="typeahead__field">--}}

                                    {{--<span class="typeahead__query">--}}
                                        {{--<input class="js-typeahead-country_v2" name="country_v2[query]" type="search" placeholder="Search" autocomplete="off">--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="col-lg-2 col-md-2 pd0">
                            <button type="submit" class="btn">Search <span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>


                </div>
                <div id="msg"></div>

                <button id="btom">Send an HTTPsult back</button>
            </div>



            <script>
                $(document).ready(function() {
                    $('#city').select2({
                        placeholder: 'Select an option'



                    });

                    $('#query').select2({


                    });
                    $('#btom').click(function (){
                     $.getJSON('{{route('searchDoc')}}',function (data) {
                            $.each(data,function (i,dat) {
                                var option = $("<option value='" + dat.id + "'>" + dat.full_name + "</option>");
                                $('#query').append(option);
                                console.log(dat.id);
                                console.log(dat.full_name);
                            });
                     });
                    });



                });
                $(document).ready(function(){

                    load_data();

                    function load_data(query)
                    {
                        $.ajax({
                            url:"fetch.php",
                            method:"POST",
                            data:{query:query},
                            success:function(data)
                            {
                                $('#result').html(data);
                            }
                        });
                    }
                    $('#search_text').keyup(function(){
                        var search = $(this).val();
                        if(search != '')
                        {
                            load_data(search);
                        }
                        else
                        {
                            load_data();
                        }
                    });
                });






            </script>
            <style>
                .select2.select2-container{
                    border-radius: 5px;

                }

                .pd0{
                    padding:2px;
                }

            </style>


            @endsection
        @stop