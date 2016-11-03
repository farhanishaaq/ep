@if(($medicineCategories) != null)
    @if(($medicineCategories->count()))
        @foreach($medicineCategories as $mC)
            <tr class="row-data">
                <td>{{{ $mC->medicine_menufacturer_name }}}</td>
                <td>{{{ $mC->name }}}</td>
                <td>{{{ $mC->dosage_form }}}</td>
                <td>{{{ $mC->description }}}</td>
                <td>
                    {{--<a href="{{route('medicineCategories.show',[$mC->id])}}" class="btn-view-icon fL" title="View Category"></a>--}}
                    {{--<span class="fL">&nbsp;|&nbsp;</span><a href="{{route('printPrescription',[$mC->id])}}" class="btn-pdf-icon fL" title="PDF Category"></a>--}}
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6"> There is no record found</td>
        </tr>
    @endif
@else
    <tr>
        <td colspan="6"> There is no record found</td>
    </tr>
@endif

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