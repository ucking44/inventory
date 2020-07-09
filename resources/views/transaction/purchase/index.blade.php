@extends('layouts.backend.app')

@push('css')
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/plugins/jquery-ui/jquery-ui.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Purchase</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Transaction</li>
            <li class="breadcrumb-item active">Purchase</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
        <div class="row">
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Purchase Order LIST</h3>
                <a class="btn btn-info btn-sm float-right" href="{{ route('purchase-order.create') }}" title="Create">Create</a>
              </div>
              <!-- /.card-header -->
                <form class="form-horizontal" method="GET" role="form" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="status" name="status">
                                <option value="0" {{ $status == "0" ? 'selected' : '' }}>All</option>
                                <option value="order" {{ $status == "order" ? 'selected' : '' }}>Order</option>
                                <option value="received" {{ $status == "received" ? 'selected' : '' }}>Received</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="startDate" class="col-sm-4 col-form-label">Start Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="startDate" name="startDate" value="{{ $startDate }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="col-sm-4 col-form-label">End Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="endDate" name="endDate" value="{{ $endDate }}">
                            </div>
                        </div>
                        <br>
                        {{-- <div class="form-group row"> --}}
                            <!-- checkbox -->
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <div class="col-md-4">
                                            <br>
                                            <label for="show-all">Show All</label>
                                            <br>
                                            <input type="checkbox" id="show-all" name="mode" value="all" {{ $mode == "all" ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-default float-left" style="margin-left: 950px;">Submit</button>
                            </div>
                        {{-- </div> --}}
                </form>
              <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Vendor Name</th>
                                <th>Total Price </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Vendor Name</th>
                                <th>Total Price </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

@endsection

@push('js')
    <!-- DataTables -->
    <script src="{{ asset('asset/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('asset/plugins/jquery-ui/jquery-ui.js') }}">
    <script>
        $(function () {
            $.ajaxSetup({
                header:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
          $("#example1").DataTable({
              resposive:true,
              processing:true,
              pagingType:'full_numbers',
              stateSave:false,
              scrollY:true,
              scrollX:true,
              ajax:"{!! url('purchase-order/datatable?status=' .$status. '&startDate=' .$startDate. '&endDate=' .$endDate. '&mode=' .$mode) !!}",
              order:[0, 'desc'],
              columns:[
                  {data:'no_invoice', name:'no_invoice'},
                  {data:'date', name:'date'},
                  {data:'name', name:'name'},
                  {data:'total', name:'total'},
                  {data:'status',
                        render:function(data) {
                            if (data == 'order') {
                                return '<span class="badge badge-warning">Order</span>';
                            }
                            if (data == 'received') {
                                return '<span class="badge badge-success">Received</span>';
                            }
                            // if (data == '2') {
                            //     return '<span class="badge badge-error">Deleted</span>';
                            // }
                        },
                    },
                    {data:'action', name:'action', searchable: false, sortable: false}
                ]
            });
        });
    </script>

    <script>
        $(function() {
            $('#startDate').datepicker({
                autoclose:true,
                dateFormat:'dd-mm-yy',
            });
            $('#endDate').datepicker({
                autoclose:true,
                dateFormat:'dd-mm-yy',
            });
        })
    </script>

    <script>
        function deleteData(dt) {
            if (confirm("Are You Sure You Want To Delete This Data?")) {
                $.ajax({
                    type:'DELETE',
                    url:$(dt).data("url"),
                    data:{
                        "_token":"{{ csrf_token() }}"
                    },
                    success:function (response) {
                        if (response.status) {
                            location.reload();
                        }
                    },
                    error:function(response) {
                        //alert(response);
                        console.log(response);
                    }
                });
            }
            return false;
        }

        function received(dt) {
            if (confirm("Are You Sure You Want To Receive This Product?")) {
                $.ajax({
                    type:'POST',
                    url:$(dt).data("url"),
                    data:{
                        "_token":"{{ csrf_token() }}"
                    },
                    success:function (response) {
                        if (response.status) {
                            location.reload();
                        }
                    },
                    error:function(response) {
                        //alert(response);
                        console.log(response);
                    }
                });
            }
            return false;
        }

    </script>
@endpush
