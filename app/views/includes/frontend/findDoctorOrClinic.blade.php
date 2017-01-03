<style>
    #map {
        width: 1px;
        height: 1px;
    }
    .tab-pane {
        background-color: white;
    }
    .FindDrIcon {
        font-family: bold;
    }
    .FindClinicIcon {
        font-family: bold;
    }
    .dr-search-container{
        margin: 75px auto;
    }

    .DrSearch .form-inline .form-group .row .form-control{
        width: 40% !important;
    }
    .DrSearch .form-inline .form-group .row .btn{
        width: 10% !important;
    }


    .DrSearch {
        background: #fff none repeat scroll 0 0;
        border-bottom: 1px solid #ddd;
        border-left: 1px solid #ddd;
        border-radius: 0 0 5px 5px;
        border-right: 1px solid #ddd;
        margin-bottom: 20px;
        margin-top: 0;
        padding: 20px;
    }
    .DrSearch .form-inline .row input.form-control {
        border: medium none;
    }
    .DrSearch .form-inline .form-group input.form-control {
        background-image: none;
        border-left: solid 1px #ddd;
        border-radius: 0px;
    }
    .DrSearch .btn-default {
        background: rgba(9,178,192,0.97) none repeat scroll 0 0;
        border-color: transparent;
        border-radius: 0 3px 3px 0;
        color: #fff;
        font-size: 16px;
        height: 48px;
        margin: 0;
        position: relative;
        left: 1px;
        text-transform: uppercase;
    }
    .DrSearch .form-inline {
        border: 1px solid #09b2c0;
        border-radius: 3px;
        margin: 0;
    }
    .DrSearch .form-inline .form-group {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .dr-search-container{
            margin: 0px auto;
        }
        .DrSearch .form-inline .form-group .row .form-control{
            width: 100% !important;
        }
        .DrSearch .form-inline .form-group .row .btn{
            width: 10% !important;
        }
    }
</style>
<div class="container dr-search-container">
    <div class="FinderHome">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a class="FindDrIcon" href="#FindDr" role="tab" data-toggle="tab">Find a doctor</a></li>
            <li role="presentation"><a class="FindClinicIcon" href="#FindClincH" role="tab" data-toggle="tab">Find a Clinic / Hospital</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            {{-- Start  Tab 1 --}}
            <div role="tabpanel" class="tab-pane active" id="FindDr">
                <div class="DrSearch">
                    <form class="form-inline row" action="" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">

                        <div class="container form-group">
                            {{--<input type="text" name="area" id="area_field" class="form-control area-field ui-autocomplete-input" placeholder="Area">--}}
                            <div class="row">
                                <input id="pac-input" class="form-control dr-search-wd" type="text" placeholder="Enter a location">
                                <input type="text" name="q" id="tags" class="form-control dr-search-wd" placeholder="Specialty, doctor or symptom.">
                                <button type="submit" class="btn btn-default  dr-search-wd">Search</button>
                            </div>
                            <div id="map"></div>
                        </div>
                    </form>
                </div>
                <br clear="all">
            </div>

            {{-- Start  Tab 2 --}}
            <div role="tabpanel" class="tab-pane" id="FindClincH">
                <div class="DrSearch">
                    <form class="form-inline row" action="https://www.myzindagi.pk/search" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">
                        <div class="form-group">
                            <input id="pac-input" class="controls form-control area-field ui-autocomplete-input" type="text" placeholder="Enter a location">
                            <div id="map"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="q" id="tags_clinic" class="form-control ui-autocomplete-input" placeholder="Name or address of organization" autocomplete="off">
                            <input type="hidden" name="results_type" id="results_type" value="organizations">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>
                <br clear="all">
            </div>
        </div>

    </div>
</div>