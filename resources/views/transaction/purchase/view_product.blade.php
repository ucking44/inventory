<table class="table table-bordered dataTable-purchase-product" cellspacing="0" style="width: 100%;" id="table-media-{{ $id_count }}">
    <thead>
        <tr>
            <td>ID</td>
            <td>Code</td>
            <td>Name</td>
            <td>Purchase Price</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- DataTables -->
<script src="{{ asset('asset/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>


<script>
    $('#table-media-{{ $id_count }}').on('click', 'tbody tr', function (e) {
        e.preventDefault();

        $('#id_raw_product_{{ $id_count }}').val($(this).find('td').html());
        $('#name_raw_product_{{ $id_count }}').val($(this).find('td').next().next().html());
        $('#price_{{ $id_count }}').val($(this).find('td').next().next().next().html());

    });

    $('.dataTable-purchase-product').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('browse-product/datatable') }}",
        columns:[
            {data:'id', name:'id'},
            {data:'code', name:'code'},
            {data:'name', name:'name'},
            {data:'purchase_price', name:'purchase_price'},
        ],
        responsive:true
    });

    $('#table-media-{{ $id_count }}').on('click', 'tbody tr', function (e) {
        $('#modal-default').modal('hide');
    })

</script>
