<table class="table table-bordered dataTable-purchase-vendor" cellspacing="0" style="width: 100%;" id="table-media">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Address</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- DataTables -->
<script src="{{ asset('asset/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>


<script>
    $('#table-media').on('click', 'tbody tr', function (e) {
        e.preventDefault();

        $('#id_ven').val($(this).find('td').html());
        $('#name_ven').val($(this).find('td').next().html());
    });

    $('.dataTable-purchase-vendor').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('browse-vendor/datatable') }}",
        columns:[
            {data:'id', name:'id'},
            {data:'name', name:'name'},
            {data:'address', name:'address'},
        ],
        responsive:true
    });

    $('#table-media').on('click', 'tbody tr', function (e) {
        $('#modal-default').modal('hide');
    })

</script>
