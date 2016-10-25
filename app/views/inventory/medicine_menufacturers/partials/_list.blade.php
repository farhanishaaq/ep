@if(($medicineMenufacturers) != null)
    @if((count($medicineMenufacturers)))
        @foreach($medicineMenufacturers as $mM)
            <tr class="row-data">
                <td>{{{ $mM->name }}}</td>
                <td>{{{ $mM->email }}}</td>
                <td>{{{ $mM->cell }}}</td>
                <td>{{{ $mM->phone }}}</td>
                <td>{{{ $mM->description }}}</td>
                <td>
                    <a href="{{route('medicineMenufacturers.show',[$mM->id])}}" class="btn-view-icon fL" title="View Medicine Manufacturer"></a>
                    <span class="fL">&nbsp;|&nbsp;</span><a href="{{route('printPrescription',[$mM->id])}}" class="btn-pdf-icon fL" title="PDF Medicine Manufacturer"></a>
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