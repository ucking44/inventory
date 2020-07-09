<?php

namespace App\Http\Controllers\Master;

use App\User;
use Illuminate\Http\Request;
use App\Model\Master\Product;
use Yajra\DataTables\DataTables;
use TJGazel\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Model\Purchase\PurchaseD;
use App\Model\Purchase\PurchaseH;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:products|max:255',
            'name' => 'required|unique:products|max:255',
        ]);

        if ($validator->fails()){
            Toastr::warning('Product Code Or Product Name Cannot Be Repeated.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else {
            $data = new Product();
            $data->code = $request->code;
            $data->name = $request->name;
            $data->selling_price = $request->sellingPrice/1;
            $data->purchase_price = $request->purchasePrice/1;
            $data->stock_available = $request->stockAvailable/1;
            $data->stock_total = $request->stockAvailable/1;
            $data->information = $request->information;
            $data->active = $request->status;
            $data->user_modified = $request->user()->id;

            if ($data->save()) {
                Toastr::success('Product Created Successfully!', 'Success');
                return redirect()->route('product.index');
            }
            else {
                Toastr::error('Product Cannot Be Created!', 'Error');
                return redirect()->back();
            }

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
        $data = Product::with(['user_modify'])->where('id', $id)->get();
        if ($data->count() > 0) {
            return view('product.view', compact('data'));
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
        $data = Product::where('id', $id)->where('active', '!=', 2)->get();
        if ($data->count() > 0) {
            return view('product.update', compact('data'));
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
        $data = Product::findOrFail($id);
            $data->code = $request->code;
            $data->name = $request->name;
            $data->selling_price = $request->sellingPrice/1;
            $data->purchase_price = $request->purchasePrice/1;
            $data->stock_available = $request->stockAvailable/1;
            $data->stock_total = $request->stockAvailable/1;
            $data->information = $request->information;
            $data->active = $request->status;
            $data->user_modified = $request->user()->id;

            if ($data->save()) {
                Toastr::success('Product Updated Successfully!', 'Success');
                return redirect()->route('product.index');
            }
            else {
                Toastr::error('Product Cannot Be Updated!', 'Error');
                return redirect()->back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
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

    public function datatable()
    {
        $data  = Product::where('active', '!=', 2);
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('master/product/'. $data->id. '/edit');
                $url = url('master/product/'. $data->id);
                $url_history = url('master/product/history/'.$data->id);
                $view = "<a class='btn btn-action btn-primary' href='".$url."' title='View'><i class='nav-icon fas fa-eye'></i></a>";
                $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>";
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>";
                $history = "<a class='btn btn-action btn-warning' href='".$url_history."' title='History' data-toggle='modal' data-target='#modal-default'>Purchase Details</a>";
                return $view."".$edit."".$delete."".$history;
            })
            ->editColumn('purchase_price', function($data){
                return number_format($data->purchase_price, 0, '.', ',');
            })
            ->editColumn('selling_price', function($data){
                return number_format($data->selling_price, 0, '.', ',');
            })
            ->editColumn('information', function($data){
                $string_replace = str_ireplace("\r\n", ',', $data->information);
                return str::limit($string_replace, 30, '...');
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID:{{$id}}')
            ->make(true);
    }

    public function datatableTrash()
    {
        $data  = Product::where('active', '=', 2);
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $url = url('master/product/'. $data->id);
                $undoTrash = url('product/undoTrash/'.$data->id);
                $view = "<a class='btn btn-action btn-primary' href='".$url."' title='View'><i class='nav-icon fas fa-eye'></i></a>";
                $undo = "<button data-url='".$undoTrash."' onclick='undoTrash(this)' class='btn btn-action btn-danger' title='Undo Trash'>Activate Product</button>";
                return $view."".$undo;
            })
            ->editColumn('purchase_price', function($data){
                return number_format($data->purchase_price, 0, '.', ',');
            })
            ->editColumn('selling_price', function($data){
                return number_format($data->selling_price, 0, '.', ',');
            })
            ->editColumn('information', function($data){
                $string_replace = str_ireplace("\r\n", ',', $data->information);
                return str::limit($string_replace, 30, '...');
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID:{{$id}}')
            ->make(true);
    }

    public function undoTrash(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        $data->active = 1;
        $data->user_modified = Auth::user()->id;
        if ($data->save()) {
            Toastr::success('Product Has Been Activated Successfully!', 'Success');
            return new JsonResponse(['status' => true]);
        }
        else {
            Toastr::error('Product Cannot Be Activated!', 'Error');
            return new JsonResponse(['status' => false]);
        }
    }

    public function datatable_product()
    {
        $data = Product::select('products.*')->where('products.active', '!=', 2);
        return Datatables::of($data)->make(true);
    }

    public function history($id)
    {
        $datas = PurchaseD::with(['purchase'])->where('id_product', $id)->orderBy('id', 'DESC')->limit(5)->get();
        return view('product.history', ['datas' => $datas]);
    }

}
