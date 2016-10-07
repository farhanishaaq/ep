
@if(($medicines) != null)
    @if(($medicines->count()))
        @foreach($medicines as $medicine)
            <tr class="row-data">
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->description }}</td>

                <td>
                    <a href="{{route('medicines.show',[$medicine->id])}}" class="btn-view-icon fL" id="view_medicine" title="View Medicine"></a>
                    <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('medicines.edit', '', [$medicine->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}
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
                        "targets": 2,
                        "orderable": false
                    } ]
                });
            }
        } );
    </script>
@stop