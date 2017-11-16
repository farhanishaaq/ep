
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
    <div class="container-fluid" style="background-image: url('{{asset('images/index_slide02.jpg')}}') ; height: 500px">

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

                    <select name="user_id" id="users" class="form-control" style="width:100%"> </select>

                </div>
                <div class="col-lg-2 col-md-2 pd0">
                    <button type="submit" class="btn">Search <span class="glyphicon glyphicon-search"></span></button>
                </div>
            </form>


        </div>
        <div id="msg"></div>

    </div>



    <script>
        $(document).ready(function() {
            $('#city').select2({
                placeholder: 'Select an option'

            });

            $('#users').select2({

                ajax : {
                    url : '{{route('testData')}}',
                    dataType : 'json',
                    delay : 200,
                    data : function(params){
                        return {
                            q : params.term,
                            page : params.page,
                            city : $( "#city" ).val()
                        };
                    },
                    processResults : function(data, params){
                        params.page = params.page || 1;
                        return {
                            results : data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    }
                },
                minimumInputLength : 1,
                templateResult : function (repo){
                    if(repo.loading)
                        return repo.full_name;

                    var markup =  repo.full_name;
                    return markup;
                },
                templateSelection : function(repo)
                {
                    return repo.full_name;
                },
                escapeMarkup : function(markup){ return markup; }
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
        #multiple-datasets .league-name {
            margin: 0 20px 5px 20px;
            padding: 3px 0;
            border-bottom: 1px solid #ccc;
        }
    </style>


@endsection
@stop