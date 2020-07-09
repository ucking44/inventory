@extends('layouts.backend.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Edit Product</li>
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
                  <h3 class="card-title">Edit Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('product.update', $data[0]->id) }}">
                    @method('PUT')
                    @csrf
                  <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="code" class="col-sm-6 col-form-label">Code</label>
                            <div class="col-sm-6">
                               <input type="text" class="form-control" id="code" value="{{ $data[0]->code }}" name="code" placeholder="Code">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="col-sm-6 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="name" value="{{ $data[0]->name }}" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="stockAvailable" class="col-sm-6 col-form-label">Stock Available</label>
                            <div class="col-sm-6">
                               <input type="number" class="form-control" id="stockAvailable" value="{{ $data[0]->stock_available }}" name="stockAvailable" placeholder="Stock Available">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="purchasePrice" class="col-sm-5 col-form-label">Purchase Price</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="purchasePrice" value="{{ $data[0]->purchase_price }}" name="purchasePrice" placeholder="Purchase Price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="sellingPrice" class="col-sm-4 col-form-label">Selling Price</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="sellingPrice" value="{{ $data[0]->selling_price }}" name="sellingPrice" placeholder="Selling Price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                               <select class="form-control" id="status" name="status">
                                   <option value="1" {{ $data[0]->active === 1 ? 'selected' : '' }}>Active</option>
                                   <option value="0" {{ $data[0]->active === 0 ? 'selected' : '' }}>Inactive</option>
                               </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">

                        </div> --}}
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="info" class="col-sm-4 col-form-label">Information</label>
                            <div class="col-sm-12">
                                <textarea name="information" class="form-control" rows="4">{{ $data[0]->information }}</textarea>
                            </div>
                        </div>
                    </div>

                  </div>
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

@endsection
