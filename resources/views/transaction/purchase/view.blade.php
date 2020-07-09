@extends('layouts.backend.app')

@push('css')

@endpush

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">View Purchase Order</h1>
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

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> Uc King
                      <small class="float-right">Date: {{ date('d F Y', strtotime($data[0]->date)) }}</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    From
                    <address>
                      <strong>Uc King</strong><br>
                      75 Ola street Itire,<br>
                      Surulere, Lagos.<br>
                      Phone: (234) 07065924160<br>
                      Email: ucking4niga@yahoo.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    To
                    <address>
                      <strong>{{ $data[0]->vendor->name }}</strong><br>
                      {{ $data[0]->vendor->address }}<br>
                      Phone: {{ $data[0]->vendor->phone }}<br>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Invoice #{{ $data[0]->no_invoice }}</b><br>
                    <br>
                    <?php
                    if ($data[0]->status == "order") {
                        $text = "Order";
                        $label = "info";
                    }
                    if ($data[0]->status == "received") {
                        $text = "Received";
                        $label = "warning";
                    }
                    ?>

                    <b>Status</b> {!! "<span class='badge badge-".$label."'>".$text."</span>" !!}<br>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($detail as $detail):
                        ?>
                      <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ number_format($detail->total, 0, '.', ',') }}</td>
                        <td>{{ number_format($detail->price, 0, '.', ',') }}</td>
                        <td>{{ number_format($detail->price * $detail->total, 0, '.', ',') }}</td>
                      </tr>
                       <?php
                       endforeach
                       ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-6">

                    </div>
                  <!-- accepted payments column -->
                  {{-- <div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                      plugg
                      dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                  </div> --}}
                  <!-- /.col -->
                  <div class="col-6">
                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                    <div class="table-responsive">
                      <table class="table">
                        {{-- <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$250.30</td>
                        </tr>
                        <tr>
                          <th>Tax (9.3%)</th>
                          <td>$10.34</td>
                        </tr>
                        <tr>
                          <th>Shipping:</th>
                          <td>$5.80</td>
                        </tr> --}}
                        <tr>
                          <th>Total:</th>
                          <td>{{ number_format($data[0]->total, 0, '.', ',') }}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                      Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Generate PDF
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection

@push('js')
@endpush
