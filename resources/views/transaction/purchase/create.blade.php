@extends('layouts.backend.app')

@push('css')
    <!-- Date -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/jquery-ui/jquery-ui.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Purchase Order</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Transaction</li>
            <li class="breadcrumb-item active">Create Purchase Order</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">

              <!-- Horizontal Form -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Create Purchase Order</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('purchase-order.store') }}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="date" class="col-sm-6 col-form-label">Date</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="date" name="date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="invoice_no" class="col-sm-6 col-form-label">Invoice No.</label>
                            <div class="col-sm-6">
                               <input type="text" class="form-control" id="invoice_no" name="invoice_no" placeholder="Invoice No">
                            </div>
                        </div>
                        {{-- <div class="form-group row"> --}}
                            <div class="col-md-12">
                                <label for="info" class="col-sm-8 col-form-label">Information</label>
                                <div class="col-sm-10">
                                    <textarea name="information" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="id_ven" class="col-sm-4 col-form-label">Supplier Name</label>
                        </div>
                            <div class="col-sm-4">
                                <input type="hidden" readonly="true" class="form-control" id="id_ven" name="id_ven">
                                <input readonly="true" type="text" name="name_ven" id="name_ven" class="form-control" placeholder="Supplier Name">
                            </div>
                            <div class="col-sm-4">
                                <a href="/transaction/purchase-order/vendor/popup_media" class="btn btn-info" title="Vendor" data-toggle="modal" data-target="#modal-default">Supplier</a>
                            </div>
                    </div>

                    <div class="col-md-12 field-wrapper">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="id_raw_product" class="col-sm-4 col-form-label">Product Name</label>
                            </div>
                                <div class="col-sm-3">
                                    <input type="hidden" readonly="true" class="form-control" id="id_raw_product_1" name="id_raw_product[]" placeholder="Product Name">
                                    <input type="text" readonly="true" class="form-control" id="name_raw_product_1" name="name_raw_product[]" placeholder="Product Name">
                                </div>
                                <div class="col-sm-2">
                                    <a href="/transaction/purchase-order/product/popup_media/1" class="btn btn-info" title="Product" data-toggle="modal" data-target="#modal-default">Product</a>
                                </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="price_1" name="price[]" placeholder="Price">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="total_1" name="total[]" placeholder="Total">
                            </div>
                            <div class="col-sm-2">
                                <a href="javascript:void(0)" class="btn btn-primary add_Button" title="Add Row"><i class="fas fa-plus"></i></a>
                            </div>

                        </div>
                    </div>
                        {{-- <div class="col-md-4">
                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                               <select class="form-control" id="status" name="status">
                                   <option value="1">Active</option>
                                   <option value="0">Inactive</option>
                               </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-4">

                        </div> --}}
                    </div>

                  {{-- </div> --}}
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-default float-right">Submit</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->

            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      {{-- Modal --}}

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection

@push('js')
<script>
    $(document).ready(function() {
        var addButton = $('.add_Button');
        var wrapper = $('.field-wrapper');
        var X = "{{ $detail_count +1 }}";

        $(addButton).click(function() {
            X++;
            $(wrapper).append(
                '<div class="form-group row">'+
                    // '<div class="col-md-12">'+
                    //     '<label for="id_raw_product" class="col-sm-4 col-form-label">Product Name</label>'+
                    // '</div>'+
                        '<div class="col-sm-3">'+
                            '<input type="hidden" readonly="true" class="form-control" id="id_raw_product_'+X+'" name="id_raw_product[]" placeholder="Product Name">'+
                            '<input type="text" readonly="true" class="form-control" id="name_raw_product_'+X+'" name="name_raw_product[]" placeholder="Product Name">'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                            '<a href="/transaction/purchase-order/product/popup_media/'+X+'" class="btn btn-info" title="Product" data-toggle="modal" data-target="#modal-default">Product</a>'+
                        '</div>'+
                    '<div class="col-sm-3">'+
                        '<input type="text" class="form-control" id="price_'+X+'" name="price[]" placeholder="Price">'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                        '<input type="text" class="form-control" id="total_'+X+'" name="total[]" placeholder="Total">'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                        '<a href="javascript:void(0)" class="btn btn-danger remove" title="Delete"><i class="fas fa-minus"></i></a>'+
                    '</div>'+
                '</div>'
            );
        });

        $(wrapper).on('click', '.remove', function(e) {
            if (confirm("Do You Want To Delete This Row?")) {
                e.preventDefault();
                $(this).parent().parent().remove();
            }
        });
    });
</script>

{{-- <link rel="stylesheet" href="{{ asset('asset/plugins/jquery-ui/jquery-ui.js') }}"> --}}

    <script>
        $(function() {
            $('#date').datepicker({
                autoclose:true,
                dateFormat:'dd-mm-yy',
            });
        })
    </script>

    <script>
        $('#modal-default').bind("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find('.modal-body').load(link.attr("href"));
        });
    </script>

@endpush

