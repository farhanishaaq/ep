{{ Form::open(array('action' => 'roles.store','class' => "form-horizontal w100p ", 'id' => 'dutyDaysForm')) }}
    <h3 class="mT10 mB0 c3">Add Roles and Permissions</h3>
    <hr class="w95p fL mT0" />
    <section class="form-Section col-md-12 fL">
        <div class="container w100p">
            <h3 class="mT15 mB0 c3">Role Info</h3>
            <hr class="w95p fL mT0" />
            <hr class="w95p fL mT0" />
            <div class="form-group">
                <label class="col-xs-3 control-label asterisk">*Name</label>
                <div class="col-xs-6">
                    <input type="text" id="name" name="name" required="true" value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control" placeholder="Name">
                    <span id="error_name" class="field-validation-msg"></span>
                </div>
            </div>

        </div>
        <div class="container w100p">
            <h3 class="mT15 mB0 c3">Permissions Info</h3>
            <hr class="w95p fL mT0" />
            <hr class="w95p fL mT0" />

            <div class="form-group">
                <label class="col-xs-3 control-label asterisk">&nbsp;</label>
                <div class="col-sm-6">
                    <div id="jstree-proton-1" style="margin-top:20px;" class="proton-demo"></div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-xs-12 taR pR0 mT20">
        <input type="reset" id="reset" value="Reset" class="submit" />
        <input type="button" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
        <input type="button" id="cancel" value="Cancel" class="submit" onclick="goTo('{{route('doctors.index')}}')" />
    </div>
{{ Form::close() }}
@section('scripts')
<link rel="stylesheet" href="{{asset('plugins/jstree/css/themes/proton/style.css')}}" type="text/css">
<script src="{{asset('plugins/jstree/js/jstree.min.js')}}"></script>
<script src="{{asset('js/view-pages/roles/RoleForm.js')}}"></script>
{{--<script src="{{asset('plugins/day-pilot-lite/js/daypilot-all.min.js')}}"></script>--}}
<link type="text/css" rel="stylesheet" href="{{asset('plugins/day-pilot-lite/css/month_white.css')}}" />
<!-- Trigger the modal with a button -->
<button id="btnOpenModel" type="button" class="btn btn-info btn-lg dN" data-toggle="modal" data-target="#myModal"></button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Duty Day</h4>
      </div>
      <div class="modal-body row">
        <div class="form-group">
            <label class="col-xs-3 control-label asterisk">Start Time</label>
            <div class="col-xs-8">
                <input type="text" id="startTime" name="startTime" value="" readonly>
                <span id="errorStartTime" class="field-validation-msg"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label asterisk">End Time</label>
            <div class="col-xs-8">
                <input type="text" id="endTime" name="endTime" value="">
                <span id="errorEndTime" class="field-validation-msg"></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" name="btnSave" class="btn btn-default" >Save</button>
        <button type="button" id="btnModalClose" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
    $(document).ready(function(){
        var options = {
            saveCloseUrl: "{{route('doctors.index')}}",
        };
//        var roleForm = new RoleForm(window,document,options);
//        roleForm.initializeAll();

        //****************************
        $('#jstree-proton-1').jstree({
            'plugins': ["wholerow", "checkbox"],
            'core': {
                'data': [{
                    "text": "Wholerow with checkboxes",
                    "children": [{
                        "text": "initially selected",
                        "state": {
                            "selected": true
                        }
                    }, {
                        "text": "custom icon URL",
//                        "icon": "./assets/images/tree_icon.png"
                    }, {
                        "text": "initially open",
                        "state": {
                            "opened": true
                        },
                        "children": ["Another node"]
                    }, {
                        "text": "custom icon class",
//                        "icon": "glyphicon glyphicon-leaf"
                    }]
                },
                    "And wholerow selection"
                ],
                'themes': {
                    'name': 'proton',
                    'responsive': true
                }
            }
        });
    });
</script>
@stop