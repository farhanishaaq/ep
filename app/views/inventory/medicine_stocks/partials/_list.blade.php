@if(($medicineStocks) != null)
    @if(($medicineStocks->count()))
        @foreach($medicineStocks as $mS)
            <tr class="row-data">
                <td>{{{ $mS->medicine_name }}}</td>
                <td>{{{ $mS->business_unit_name }}}</td>
                <td>{{{ $mS->location_name }}}</td>
                <td>{{{ $mS->minimum_quantity }}}</td>
                <td>{{{ $mS->quantity }}}</td>
                <td>
                    <a href="{{route('medicineStocks.show',[$mS->id])}}" class="btn-view-icon fL" title="View Medicine Stock"></a>
                    <span class="fL">&nbsp;|&nbsp;</span><a href="{{route('printPrescription',[$mS->id])}}" class="btn-pdf-icon fL" title="PDF Medicine Stock"></a>
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