@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Companies
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
     <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Companies List</h1>
     <hr class="w100p fL mT0" />
		<!--========================================================
                                     Data Table
        =========================================================-->
    <section id="form-Section">
         {{ link_to_route('companies.create', 'Register Company', '', ['class' => 'btn_1'])}}
         <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
             <thead>
                 <tr>
                     <th>Company Name</th>
                     <th>Address</th>
                     <th>Actions</th>
                 </tr>
             </thead>
             <tbody>
             @if(($companies) != null )
                 @if(($companies->count()))
                     @foreach($companies as $company)
                          <tr>
                             <td> {{$company->name}}</td>
                             <td>{{ $company->address }}</td>
                              <td>
                                  {{ link_to_route('companies.show', '', [$company->id], ['class' => 'btn-view-icon fL', 'title'=> 'View Record'])}}
                                  <span class="fL">&nbsp;|&nbsp;</span> {{ link_to_route('companies.edit', '', [$company->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}
                                  {{ Form::model($company, ['route' => ['companies.destroy', $company->id], 'method' => 'delete', 'style' => 'display: inline'] )}}
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
         {{ $companies->links('partials.pagination') }}
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
