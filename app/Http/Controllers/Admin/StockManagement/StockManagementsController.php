<?php

namespace App\Http\Controllers\Admin\StockManagement;

use App\Models\Products;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Master\CategoryMaster;
use App\Models\StockManagementData;
use App\Models\StockManagementLog;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class StockManagementsController extends Controller
{
    public function index(){
        $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        return view('Admin.Stock.stock',compact('category_list'));
    }

    public function data_table(Request $request){
        $table_data = Products::where('products.status', '!=', 'delete')
                        ->when($request->category_id, function ($query, $category_id) {
                            return $query->where('products.category_id', $category_id);
                        })
                        ->when($request->sub_category_id, function ($query, $sub_category_id) {
                            return $query->where('products.sub_category_id', $sub_category_id);
                        })
                        ->when($request->sub_sub_category_id, function ($query, $sub_sub_category_id) {
                            return $query->where('products.sub_sub_category_id', $sub_sub_category_id);
                        })
                        ->leftJoin('sub_sub_category_masters', 'products.sub_sub_category_id', '=', 'sub_sub_category_masters.id')
                        ->leftJoin('sub_category_masters', 'products.sub_category_id', '=', 'sub_category_masters.id')
                        ->join('category_masters', 'products.category_id', '=', 'category_masters.id')
                        ->join('brands_masters', 'products.brand_id', '=', 'brands_masters.id')
                        ->orderBy('products.id', 'DESC')
                        ->select(
                            'products.id',
                            'products.product_id', 
                            'products.product_name',
                            'products.price',
                            'products.offer_price',
                            'products.current_stock',
                            'products.stock_remark',
                            'products.is_available',
                            'products.product_main_image', 
                            'brand_name',
                            'sub_sub_category_masters.sub_sub_category_name',
                            'sub_category_masters.sub_category_name', 
                            'category_masters.category_name'
                        )
                        ->get();


        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return !empty($row->product_id) ? $row->product_id : '' ;
                })
                ->addColumn('category_name', function ($row) {
                    return !empty($row->category_name) ? $row->category_name : '' ;
                })
                ->addColumn('sub_category_name', function ($row) {
                    return !empty($row->sub_category_name) ? $row->sub_category_name : '' ;
                })
                ->addColumn('sub_sub_category_name', function ($row) {
                    return !empty($row->sub_sub_category_name) ? $row->sub_sub_category_name : '' ;
                })
                ->addColumn('product_name', function ($row) {
                    return !empty($row->product_name) ? $row->product_name : '' ;
                })
                ->addColumn('price', function ($row) {
                    return !empty($row->price) ? $row->price : '' ;
                })
                ->addColumn('offer_price', function ($row) {
                    return !empty($row->offer_price) ? $row->offer_price : '' ;
                })
                ->addColumn('current_stock', function ($row) {
                    return !empty($row->current_stock) ? $row->current_stock : '0' ;
                })
                ->addColumn('stock_remark', function ($row) {
                    return !empty($row->stock_remark) ? $row->stock_remark : '' ;
                })
                ->addColumn('is_available', function ($row) {
                    return !empty($row->is_available) ? ucwords(str_replace('_',' ',$row->is_available)) : '' ;
                })
                ->addColumn('action', function ($row) {
                    $product_main_image = !empty($row->product_main_image) && Storage::exists($row->product_main_image) ? url('/').Storage::url($row->product_main_image) : '';
                    $actionBtn = '';
                    $actionBtn .= '<label type="button" data-category-name="' . $row->category_name . '" data-sub-category-name="' . $row->sub_category_name . '" data-sub-sub-category-name="' . $row->sub_sub_category_name . '" data-product-id="'.$row->product_id.'" data-product-name="'.$row->product_name.'" data-id="'.$row->id.'" data-product-main-image="'.$product_main_image.'" data-current-stock="'.$row->current_stock.'" data-is-available="'.$row->is_available.'" class="btn btn-warning btn-sm Edit_button btn-edit-stock" title="Edit" data-bs-toggle="modal" data-bs-target="#editPopup"><i class="mdi mdi-pencil"></i></label>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'id' => 'required',
            'current_stock' => 'required',
            'stock_remark' => 'required',
        ]);
        $input = $request->all();
        if (!empty($id)) {
                $id = $id;
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();

                Products::find($id)->update($input);
                // stock data
                $logData = [
                    'product_id' => $id,
                    'current_stock' => $input['current_stock'],
                    'stock_remark' => $input['stock_remark'],
                ];
                $logData['created_by'] = auth()->guard('master_admins')->user()->id;
                $logData['created_ip_address'] = $request->ip();
                $is_exists = StockManagementData::where('product_id',$id)->where('status','active')->select('id')->first();
                $stock_data_id = '';
                if(!empty($is_exists->id)){
                    StockManagementData::where('product_id',$id)->where('status','active')->update($logData);
                    $stock_data_id = $is_exists->id;
                }else{
                    $insert = StockManagementData::create($logData);
                    $stock_data_id = $insert->id;
                }
                // stock log
                $logData = [
                    'product_id' => $id,
                    'current_stock' => $input['current_stock'],
                    'stock_remark' => $input['stock_remark'],
                    'stock_data_id' => $stock_data_id
                ];
                $logData['created_by'] = auth()->guard('master_admins')->user()->id;
                $logData['created_ip_address'] = $request->ip();
                StockManagementLog::create($logData);
                return redirect('admin/stock')->with('success', 'Data Updated Successfully!');
            
        } else {
                return redirect('admin/stock')->with('success', 'Something went wrong!');
        }
    }
}
