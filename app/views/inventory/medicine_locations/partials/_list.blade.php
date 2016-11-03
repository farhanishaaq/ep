@if(($medicineLocations) != null)
    @if((count($medicineLocations)))
        @foreach($medicineLocations as $mL)
            <tr class="row-data">
                <td>{{{ $mL->name }}}</td>
                <td>{{{ $mL->description }}}</td>
                <td>
                    {{--<a href="{{route('prescriptions.show',[$mL->id])}}" class="btn-view-icon fL" title="View Location"></a>--}}
                    {{--<span class="fL">&nbsp;|&nbsp;</span><a href="{{route('printPrescription',[$mL->id])}}" class="btn-pdf-icon fL" title="PDF Medicine Location"></a>--}}
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