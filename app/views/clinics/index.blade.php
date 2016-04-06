@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Clinics
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
        {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
    </div>
</div>
@stop

@section('sliderContent')
@stop

<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
 <div class="container mT20">
     <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Clinics List</h1>
     <hr class="w100p fL mT0" />
		<!--========================================================
                                     Data Table
        =========================================================-->
    <section id="form-Section">
         {{ link_to_route('clinics.create', 'Register Clinic', '', ['class' => 'btn_1'])}}
         <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
             <thead>
                 <tr>
                     <th>Clinic Name</th>
                     <th>Address</th>
                     <th>Actions</th>
                 </tr>
             </thead>
             <tbody>
             @if(($clinics) != null )
                 @if(($clinics->count()))
                     @foreach($clinics as $clinic)
                          <tr>
                             <td> {{$clinic->name}}</td>
                             <td>{{ $clinic->address }}</td>
                              <td>
                                  {{ link_to_route('clinics.show', '', [$clinic->id], ['class' => 'btn-view-icon fL', 'title'=> 'View Record'])}}
                                  <span class="fL">&nbsp;|&nbsp;</span> {{ link_to_route('clinics.edit', '', [$clinic->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}
                                  {{ Form::model($clinic, ['route' => ['clinics.destroy', $clinic->id], 'method' => 'delete', 'style' => 'display: inline'] )}}
                                      {{ Form::button('Delete', ['type' => 'submit', 'class' => 'data_table_submit_btn']) }}
                                  {{Form::close()}}
                              </td>
                          </tr>
                      @endforeach
                 @else
                     <tr>
                         <td colspan="3"> There is no record found</td>
                     </tr>
                 @endif
             @else
                 <tr>
                      <td colspan="3"> There is no record found</td>
                 </tr>
             @endif
             </tbody>
         </table>
         {{ $clinics->links('partials.pagination') }}
     </section>
</div>
@stop


@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    if($('#tblRecordsList tr.row-data').length){
        $('#tblRecordsList').DataTable({
            "columnDefs": [ {
            "targets": 3,
            "orderable": false
            } ]
        });
    }
} );
</script>
@stop
