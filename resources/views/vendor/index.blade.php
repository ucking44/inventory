@extends('layouts.backend.app')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vendor</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Vendor</li>
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
                <h3 class="card-title">VENDOR LIST</h3>
                <a class="btn btn-info btn-sm float-right" href="{{ route('vendor.create') }}" title="Create">Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>Phone No.</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>Phone No.</th>
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
    <script>
        $(function () {
          $("#example1").DataTable({
              resposive:true,
              processing:true,
              pagingType:'full_numbers',
              stateSave:false,
              scrollY:true,
              scrollX:true,
              ajax:"{{ url('vendor/datatable') }}",
              order:[0, 'desc'],
              columns:[
                  {data:'name', name:'name'},
                  {data:'address', name:'address'},
                  {data:'cp', name:'cp'},
                  {data:'phone', name:'phone'},
                  {data:'active',
                        render:function(data) {
                            if (data == '0') {
                                return '<span class="badge badge-warning">Inactive</span>';
                            }
                            if (data == '1') {
                                return '<span class="badge badge-success">Active</span>';
                            }
                            if (data == '2') {
                                return '<span class="badge badge-error">Deleted</span>';
                            }
                        },
                    },
                    {data:'action', name:'action', searchable: false, sortable: false}
                ]
            });
        });
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
    </script>
@endpush
