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
                   <label>Roles
                    <select name="roles" id="role" class="form-control">
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}} </option>
                        @endforeach
                    </select>
                   </label>
                    {{--<input type="text" id="name" name="name" required="true" value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control" placeholder="Name">--}}
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
                    <div id="jstree-proton-1" style="margin-top:20px;" class="proton-demo">

                            <ul>
                                @foreach($controllers as $controller)
                                <li>{{$controller->name}}
                                    <ul>

                                        @foreach($actions as $action)
                                            @if($action->parent_id==$controller->id)

                                                <li id="{{$action->id}}"> {{$action->name}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                    @endforeach
                            </ul>

                    </div>
                    <input type="hidden" name="actions" id="jsfields" value="" />
                </div>
            </div>
        </div>
    </section>
    <div class="col-xs-12 taR pR0 mT20">
        <input type="reset" id="reset" value="Reset" class="submit" />
        <input type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
        <button onclick="submitMe()" class="submit" >submiaaatt</button>
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
<!-- Modal -->


    <!-- Modal content-->



<script>
    $(document).ready(function(){
        var options = {
            saveCloseUrl: "{{route('doctors.index')}}",
        };
//        var roleForm = new RoleForm(window,document,options);
//        roleForm.initializeAll();

        //****************************
        $('#jstree-proton-1')
        // listen for event
            .on('changed.jstree', function (e, data) {
                var i, j, r = [];
                for(i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).text);
                }
                //console.log(data.node.li_attr);
                //console.log(data);
//                for (i=0;i<data.selected.length;i++){
//                    console.log(data.selected[i]);
//                    value = data.selected[i];
//                    $( "#" + value).attr( "checked", true );
//                    console.log($( "#" + value));
//                    console.log($( "#" + value).prop( "checked"))
//                }
              //  alert('Selected: ' + r.join(', ') +" :" );

            })

            .jstree({
                'plugins': ["wholerow", "checkbox"],
                'core': {

                    'themes': {
                        'name': 'proton',
                        'responsive': true
                    }
                }
            });



        });
//        $('#jstree-proton-1').jstree({
//            'plugins': ["wholerow", "checkbox"],
//            'core': {
//                'data': [{
//                    "text": "Wholerow with checkboxes",
//                    "children": [{
//                        "text": "initially selected",
//                        "state": {
//                            "selected": true
//                        }
//                    }, {
//                        "text": "custom icon URL",
////                        "icon": "./assets/images/tree_icon.png"
//                    }, {
//                        "text": "initially open",
//                        "state": {
//                            "opened": true
//                        },
//                        "children": ["Another node"]
//                    }, {
//                        "text": "custom icon class",
////                        "icon": "glyphicon glyphicon-leaf"
//                    }]
//                },
//                    "And wholerow selection"
//                ],
//                'themes': {
//                    'name': 'proton',
//                    'responsive': true
//                }
//            }
//        });
//    });


    function submitMe() {
        var checked_ids = [];
//        $('#jstree-proton-1').jstree("get_checked",null,true).each(function(){
//            checked_ids.push(this.id);
//        });
//        //setting to hidden field
//        document.getElementById('jsfields').value = checked_ids.join(",");

        //   $('#dutyDaysForm').submit();

        selectedElmsIds = [];
        var selectedElms = $('#jstree-proton-1').jstree("get_selected", true);
        $.each(selectedElms, function() {
            if(this.id.charAt(0)!=='j'){

                selectedElmsIds.push(this.id);

            }
            console.log(this.id);
        });
        $('#jsfields').val(selectedElmsIds.join(","))  ;
        console.log(selectedElmsIds);
        $('#dutyDaysForm').submit();

    }
</script>
@stop