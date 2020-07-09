<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Model\Master\Product;
use App\Model\Purchase\PurchaseD;
use App\Model\Purchase\PurchaseH;
use App\Model\Transaction\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;
//use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = "0";
        $startDate = "01" . "-" . date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "all";

        if ( (isset($_GET["startDate"])) && (($_GET["startDate"]) !== '') ) {
            $startDate = $_GET["startDate"];
        }

        if ( (isset($_GET["endDate"])) && (($_GET["endDate"]) !== '') ) {
            $endDate = $_GET["endDate"];
        }

        if ( (isset($_GET["status"])) && (($_GET["status"]) !== '') ) {
            $status = $_GET["status"];
        }

        if ( !isset($_GET["mode"])) {
            $mode = "limited";
        }

        return view('transaction.purchase.index', compact('status', 'startDate', 'endDate', 'mode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detail_count = 0;
        return view('transaction.purchase.create', compact('detail_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new PurchaseH();
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->no_invoice = $request->invoice_no; //$request->invoice_no;
        $data->id_ven = $request->id_ven;
        $data->information = $request->information;
        $data->status = 'order';
        $data->active = 1;
        $data->user_modified = Auth::user()->id;
        $total = 0;
        if ($data->save()) {
            $id_purchase = $data->id;
            if (isset($_POST['id_raw_product'])) {
                foreach ($_POST['id_raw_product'] as $key=>$id_raw_product);
                    $detail = new PurchaseD();
                    $detail->id_purchase = $data->id;
                    $detail->id_product = $id_raw_product;
                    $detail->total = $_POST['total'][$key];
                    $detail->price = $_POST['price'][$key];
                    $total = $total + ($detail->total * $detail->price);
                    $detail->save();
                //endforeach
            }

            $data = PurchaseH::findOrFail($id_purchase);
            $data->total = $total;
            $data->save();

            Toastr::success('Data Saved Successfully!', 'Success');
            return redirect()->route('purchase-order.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PurchaseH::with(['user_modify', 'vendor'])->where('id', $id)->get();

        if ($data->count() > 0) {
            $detail = PurchaseD::with('product')->where('id_purchase', '=', $data[0]->id)->orderBy('id', 'ASC')->get();
            return view('transaction.purchase.view', compact('data', 'detail'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail_count = 0;
        $data = PurchaseH::with('vendor')->where('id', $id)->where('active', '!=', 2)->get();

        if ($data->count() > 0) {
            $detail = PurchaseD::with('product')->where('id_purchase', '=', $data[0]->id)->orderBy('id', 'ASC')->get();

            return view('transaction.purchase.update', compact('detail_count', 'data', 'detail'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = PurchaseH::findOrFail($id);
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->no_invoice = $request->invoice_no; //$request->invoice_no;
        $data->id_ven = $request->id_ven;
        $data->information = $request->information;
        //$data->status = 'order';
        //$data->active = 1;
        $data->user_modified = Auth::user()->id;
        $total = 0;
        if ($data->save()) {
            $delete = PurchaseD::where('id_purchase', '=', $id)->delete();
            // $id_purchase = $data->id;
            if (isset($_POST['id_raw_product'])) {
                foreach ($_POST['id_raw_product'] as $key=>$id_raw_product);
                    $detail = new PurchaseD();
                    $detail->id_purchase = $id;
                    $detail->id_product = $id_raw_product;
                    $detail->total = $_POST['total'][$key];
                    $detail->price = $_POST['price'][$key];
                    $total = $total + ($detail->total * $detail->price);
                    $detail->save();
                //endforeach
            }

            $data = PurchaseH::findOrFail($id);
            $data->total = $total;
            $data->save();

            Toastr::success('Data Updated Successfully!', 'Success');
            return redirect()->route('purchase-order.index');
        }

            Toastr::error('Data Cannot Be Updated!', 'Error');
            return redirect()->route('purchase-order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PurchaseH::findOrFail($id);
        $data->active = 2;
        $data->user_modified = Auth::user()->id;
        if ($data->save()) {
            Toastr::success('Product Deleted Successfully!', 'Success');
            return new JsonResponse(['status' => true]);
        }
        else {
            Toastr::error('Product Cannot Be Deleted!', 'Error');
            return new JsonResponse(['status' => false]);
        }
    }

    public function popup_media_vendor()
    {
        return view('transaction.purchase.view_vendor');
    }

    public function popup_media_product($id_count = null)
    {
        return view('transaction.purchase.view_product')->with('id_count', $id_count);
    }

    public function datatable()
    {
        if (isset($_GET['status']) && $_GET['status'] != '') {
            $status= $_GET['status'];
        }
        else {
            $status = 0;
        }

        $startDate = "01" . "-" . date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "all";

        if (isset($_GET['startDate']) && $_GET['startDate'] != '') {
            $startDate= $_GET['startDate'];
        }

        if (isset($_GET['endDate']) && $_GET['endDate'] != '') {
            $endDate= $_GET['endDate'];
        }

        if (isset($_GET['mode'])) {
            $mode = $_GET['mode'];
        }

        $startDateQuery = date('Y-m-d', strtotime($startDate));
        $endDateQuery = date('Y-m-d', strtotime($endDate));

        if ($status == "0") {
            if ($mode == "all") {
                $data = PurchaseH::select('purchase_h.*', 'vendors.name')->leftJoin('vendors', 'purchase_h.id_ven', '=', 'vendors.id')->where('purchase_h.active', '!=', '2');
            }
            if ($mode == "limited") {
                $data = PurchaseH::select('purchase_h.*', 'vendors.name')->leftJoin('vendors', 'purchase_h.id_ven', '=', 'vendors.id')->where('purchase_h.active', '!=', '2')->whereBetween('purchase_h.date', [$startDateQuery, $endDateQuery]);
            }
        }
        else {
            if ($mode == "all") {
                $data = PurchaseH::select('purchase_h.*', 'vendors.name')->leftJoin('vendors', 'purchase_h.id_ven', '=', 'vendors.id')->where('purchase_h.active', '!=', '2')->where('purchase_h.status', "=", $status);
            }
            if ($mode == "limited") {
                $data = PurchaseH::select('purchase_h.*', 'vendors.name')->leftJoin('vendors', 'purchase_h.id_ven', '=', 'vendors.id')->where('purchase_h.active', '!=', '2')->where('purchase_h.status', "=", $status)->whereBetween('purchase_h.date', [$startDateQuery, $endDateQuery]);
            }
        }

        return DataTables::of($data)
            ->addColumn('action', function($data) {
                $url_edit = url('transaction/purchase-order/'.$data->id.'/edit');
                $url = url('transaction/purchase-order/'.$data->id);
                $url_receive = url('transaction/purchase-order/receive/'.$data->id);
                $view = "<a class='btn btn-action btn-primary' href='" .$url. "' title='view'><i class='nav-icon fas fa-eye'></i></a>";
                $edit = "";
                $receive = "";
                $delete = "";

                if ($data->status == "order") {
                    $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>";
                    $receive = "<button data-url='".$url_receive."' onclick='received(this)' class='btn btn-action btn-outline-warning' title='Receive'>Receive</button>";
                    $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>";

                    return $view. "" .$edit. "" . "" .$delete. "" .$receive;
                }
                else {
                    return $view;
                }
            })
            ->editColumn('date', function($data) {
                return date('d-m-Y', strtotime($data->date));
            })

            ->editColumn('total', function($data) {
                return number_format($data->total, 0, '.', ',');
            })

            ->make(true);
    }

    public function received(Request $request, $id)
    {
        $dataH = PurchaseH::findOrFail($id);
        $data = PurchaseD::where('id_purchase', '=', $id)->orderBy('id', 'ASC')->get();

        foreach ($data as $data ) {
            $detail = new Stock();
            $detail->id_product = $data->id_product;
            $detail->total = $data->total;
            $detail->information = $dataH->invoice_no;
            $detail->type = "buy";
            $detail->save();

            $detail = Product::findOrFail($data->id_product);
            $detail->purchase_price = $data->price;
            $detail->stock_total = $detail->stock_total + $data->total;

            $detail->save();
        }

        $data = PurchaseH::findOrFail($id);
        $data->status = 'received';
        //dd($data);
        $data->user_modified = Auth::user()->id;
        if ($data->save()) {
            Toastr::success('Data Received Successfully!', 'Success');
            return new JsonResponse(['status' => true]);
        }
        else {
            Toastr::error('Data Cannot Be Received!', 'Error');
            return new JsonResponse(['status' => false]);
        }
    }

}
