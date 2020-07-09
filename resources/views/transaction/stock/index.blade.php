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
            <h1 class="m-0 text-dark">Stock</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Transaction</li>
            <li class="breadcrumb-item active">Stock Correction</li>
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
                  <h3 class="card-title">Stock Correction</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('transaction/stock') }}">
                    @csrf
                  <div class="card-body">
                    {{-- <div class="form-group row">


                    </div> --}}

                    <div class="col-md-12 field-wrapper">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="id_raw_product" class="col-sm-4 col-form-label">Product Name</label>
                            </div>
                                <div class="col-sm-3">
                                    <input type="hidden" readonly="true" class="form-control" id="id_raw_product_1" name="id_raw_product" placeholder="Product Name">
                                    <input type="text" readonly="true" class="form-control" id="name_raw_product_1" name="name_raw_product" placeholder="Product Name">
                                </div>
                                <div class="col-sm-2">
                                    <a href="/transaction/stock/product/popup_media" class="btn btn-info" title="Product" data-toggle="modal" data-target="#modal-default">Product</a>
                                </div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="total" class="col-sm-4 col-form-label">Total</label>
                        </div>
                            <div class="col-sm-4">
                                <input type="number" name="total" id="total" class="form-control" placeholder="Total">
                            </div>
                            <div class="col-sm-4">
                                {{-- <a href="/transaction/purchase-order/vendor/popup_media" class="btn btn-info" title="Vendor" data-toggle="modal" data-target="#modal-default">Supplier</a> --}}
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
        $('#modal-default').bind("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find('.modal-body').load(link.attr("href"));
        });
    </script>

@endpush

