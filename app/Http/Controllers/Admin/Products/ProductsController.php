<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Products;
use App\Traits\MediaTrait;
use App\Models\CartProduct;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use App\Models\Master\GstMaster;
use App\Models\ProductsPdfFiles;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Master\BrandsMaster;
use App\Http\Controllers\Controller;
use App\Models\Master\CategoryMaster;
use App\Models\ProductsGalleryImages;
use App\Models\ProductsParameterData;
use Illuminate\Support\Facades\Crypt;
use App\Models\Master\SubCategoryMaster;
use App\Models\ProductsDescriptionImages;
use App\Models\Master\SubSubCategoryMaster;
use App\Models\Master\ProductParameterMaster;
use App\Models\Master\ProductParameterValueMaster;

class ProductsController extends Controller
{
    use MediaTrait;
    public function index(){
        $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        
        return view('Admin.Product.product',compact('category_list'));
    }

    public function create(){
        
        //product parameter
        $parameter_list = ProductParameterMaster::where('status','=','active')->select('id','product_parameter_name')->where('status','active')->get();
        
        foreach($parameter_list as $k => $val){
            $val->param_values = ProductParameterValueMaster::where('product_parameter_id',$val->id)
                                    ->where('status','active')
                                    ->select('id','product_parameter_value','product_parameter_id')
                                    ->get();
        }
        
        $gst_list = GstMaster::where('status','=','active')->get();

        $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        $brand_list = BrandsMaster::where('status', '=', 'active')->orderBy('brand_name','asc')->select('id', 'brand_name')->get();
        
        // $category_list = '';
        // $brand_list= '';
        // $gst_list= '';
        // $parameter_list= '';

        return view('Admin.Product.add-product',compact('category_list','brand_list','gst_list','parameter_list'));
    }

    public function store(Request $request){
        $id = $request->id;
        $validateData = $request->validate([
            'category_id'        => 'required',
            // 'sub_category_id'    => 'required',
            // 'sub_sub_category_id'=> 'required',
            'brand_id'           => 'required',
            'product_name'       => 'required',
            'slug_url'           => 'required',
            'sku'                => 'required',
            'price'              => 'required',
            'offer_price'        => 'required',
            //'gst_id'             => 'required',
            //'description'        => 'required',
            //'specification'      => 'required',
            //'meta_title'         => 'required',
            //'meta_keywords'      => 'required',
            //'meta_description'   => 'required',

        ]);
        $input = $request->all();
        $input_files = $request->all();
        if(!empty($input['extra_tab']) && $input['extra_tab']=='yes' && !empty($input['controller_products'])){
            $input['controller_product_ids'] = implode(',',$input['controller_products']);
        }else{
            $input['controller_product_ids'] = '';
        }
        
        if(!empty($input['product_main_image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'product_main_image', 
                    'uploads/product_images', 
                    strtolower( str_replace(' ','-',$request->input('product_name')))
                );
            if(!empty($file_path)){
                    $input['product_main_image'] = $file_path;
            }
        }
        
        //chmod(storage_path('app/uploads/product_images'), 0755);

        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Products::find($id)->update($input);
                
                if(!empty($input_files['product_parameter_chkbx'])){
                    //ProductsParameterData::where('product_id',$id)->update(['status'=>'delete']);
                    ProductsParameterData::where('product_id', $id)->delete();

                    foreach ($input_files['product_parameter_chkbx'] as $k => $val) {
                        $pp_input['created_by'] = auth()->guard('master_admins')->user()->id;
                        $pp_input['created_ip_address'] = $request->ip();
                        $pp_input['parameter_name_id'] = $val;
                        $pp_input['parameter_value_id'] = $input_files['product_parameter'][$k];
                        $pp_input['product_id'] = $id;
                        ProductsParameterData::create($pp_input);
                    }
                }

                if (!empty($input['edit_product_pdf_file_ids'])) {
                    foreach ($input['edit_product_pdf_file_ids'] as $k => $edit_pdf_id) {
                        if (!empty($edit_pdf_id)) {
                            $pdf_input = [];
                            //$pdf_input['id'] = $edit_pdf_id;
                            $pdf_input['product_pdf_file_name'] = $input['edit_product_pdf_file_name'][$k] ?? '';
                            $pdf_input['product_id'] = $id;
                            $pdf_input['modified_by'] = auth()->guard('master_admins')->user()->id;
                            $pdf_input['modified_ip_address'] = $request->ip();
                            $uploadedFile = $input_files['edit_product_pdf_file'][$k] ?? null;
                
                            if (!empty($uploadedFile) && $uploadedFile->isValid()) {
                                $file_name = $pdf_input['product_pdf_file_name'];
                                $newFileName = 'product_' . time() . '_' . $k . 'up.' . $uploadedFile->getClientOriginalExtension();
                                $path = $uploadedFile->storeAs('public/uploads/product_pdf_files', $newFileName);
                                $pdf_input['product_pdf_file'] = '' . $path;
                                $pdf_input['product_pdf_file_name'] = $file_name;
                            }
                
                            // Uncomment below if you want to actually update
                            ProductsPdfFiles::where('id', $edit_pdf_id)->update($pdf_input);
                        }
                    }
                }

                if(!empty($input_files['product_pdf_file'])){
                    foreach ($input_files['product_pdf_file'] as $k => $val) {
                        if ($val->isValid()) {
                            $file_name = $input_files['product_pdf_file_name'][$k]; 
                            $newFileName = 'product_' . time() . '_' . $k . '.' . $val->getClientOriginalExtension();
                            $path = $val->storeAs('public/uploads/product_pdf_files', $newFileName);
                            $pdf_input['created_by'] = auth()->guard('master_admins')->user()->id;
                            $pdf_input['created_ip_address'] = $request->ip();
                            $pdf_input['product_pdf_file'] = ''.$path;
                            $pdf_input['product_pdf_file_name'] = $file_name;
                            $pdf_input['product_id'] = $id;
                            ProductsPdfFiles::create($pdf_input);        
                        }
                    }
                }

                if (!empty($input['edit_product_description_ids'])) {
                    foreach ($input['edit_product_description_ids'] as $k => $edit_desc_id) {
                        if (!empty($edit_desc_id)) {
                            $dsc_file_input = [];
                            //$dsc_file_input['id'] = $edit_desc_id;
                            $dsc_file_input['product_discription_name'] = $input['edit_product_discription_name'][$k] ?? '';
                            $dsc_file_input['product_id'] = $id;
                            $dsc_file_input['modified_by'] = auth()->guard('master_admins')->user()->id;
                            $dsc_file_input['modified_ip_address'] = $request->ip();
                            $uploadedFile = $input_files['edit_product_description_image'][$k] ?? null;
                
                            if (!empty($uploadedFile) && $uploadedFile->isValid()) {
                                $file_name = $dsc_file_input['product_discription_name'];
                                $newFileName = 'product_' . time() . '_' . $k . 'up.' . $uploadedFile->getClientOriginalExtension();
                                $path = $uploadedFile->storeAs('public/uploads/products_description_image', $newFileName);
                                $dsc_file_input['product_description_image'] = '' . $path;
                                $dsc_file_input['product_discription_name'] = $file_name;
                            }
                
                            // Uncomment below if you want to actually update
                            ProductsDescriptionImages::where('id',$edit_desc_id)->update($dsc_file_input);        

                        }
                    }
                }

                if(!empty($input_files['product_discription_image'])){
                    foreach ($input_files['product_discription_image'] as $k => $val) {
                        if ($val->isValid()) {
                            $file_name = $input_files['product_discription_name'][$k]; 
                            $newFileName = strtolower(str_replace(' ','-',$file_name)).'_product_' . time() . '_' . $k . '.' . $val->getClientOriginalExtension();
                            $path = $val->storeAs('public/uploads/product_discription_images', $newFileName);
                            $file_input1['created_by'] = auth()->guard('master_admins')->user()->id;
                            $file_input1['created_ip_address'] = $request->ip();
                            $file_input1['product_discription_image'] = ''.$path;
                            $file_input1['product_discription_name'] = $file_name;
                            $file_input1['product_id'] = $id;
                            ProductsDescriptionImages::create($file_input1);        
                        }
                    }
                }

                if(!empty($input_files['gallery_images'])){
                    $path = 'uploads/product_images';
                    $rename = strtolower( str_replace(' ','-',$request->input('product_name'))).'-gallery-up';
                    $files = $request->file('gallery_images');
                    $uploadedFiles = $this->uploadFilesWithRename($files, $path,$rename);
                    unset($uploadedFiles['name']);
                    if(!empty($uploadedFiles)){
                            $input_files['gallery_images'] = implode(',',$uploadedFiles);
                            foreach($uploadedFiles as $k => $value){
                                $gallery_data = [
                                    'product_id' =>$id,
                                    'product_gallery_image' => $value
                                ];
                                $gallery_data['created_by'] = auth()->guard('master_admins')->user()->id;
                                $gallery_data['created_ip_address'] = $request->ip();
                                ProductsGalleryImages::create($gallery_data);
                            }
                                
                    }
                }
                    
                
                return redirect('admin/product')->with('success', 'Product updated successfully!');
            
        } else {
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                unset($input['product_pdf_file']);
                unset($input['product_description_image']);
                unset($input['gallery_images']);
                $result = Products::create($input);
                if(!empty($result->id)){
                    $id = $result->id;
                    $product_id = 'PROD' . str_pad($id, 7, '0', STR_PAD_LEFT);
                    Products::find($id)->update(['product_id'=>$product_id,'current_stock'=>0,'is_available' => 'available']);
                    if(!empty($input_files['product_parameter_chkbx'])){
                        foreach ($input_files['product_parameter_chkbx'] as $k => $val) {
                            $pp_input['created_by'] = auth()->guard('master_admins')->user()->id;
                            $pp_input['created_ip_address'] = $request->ip();
                            $pp_input['parameter_name_id'] = $val;
                            $pp_input['parameter_value_id'] = $input_files['product_parameter'][$k];
                            $pp_input['product_id'] = $id;
                            ProductsParameterData::create($pp_input);
                        }
                    }

                    if(!empty($input_files['product_pdf_file'])){
                        foreach ($input_files['product_pdf_file'] as $k => $val) {
                            if ($val->isValid()) {
                                $file_name = $input_files['product_pdf_file_name'][$k]; 
                                $newFileName = 'product_' . time() . '_' . $k . '.' . $val->getClientOriginalExtension();
                                $path = $val->storeAs('public/uploads/product_pdf_files', $newFileName);
                                $pdf_input['created_by'] = auth()->guard('master_admins')->user()->id;
                                $pdf_input['created_ip_address'] = $request->ip();
                                $pdf_input['product_pdf_file'] = ''.$path;
                                $pdf_input['product_pdf_file_name'] = $file_name;
                                $pdf_input['product_id'] = $id;
                                ProductsPdfFiles::create($pdf_input);        
                            }
                        }
                    }

                    if(!empty($input_files['product_discription_image'])){
                        foreach ($input_files['product_discription_image'] as $k => $val) {
                            if ($val->isValid()) {
                                $file_name = $input_files['product_discription_name'][$k]; 
                                $newFileName = strtolower(str_replace(' ','-',$file_name)).'_product_' . time() . '_' . $k . '.' . $val->getClientOriginalExtension();
                                $path = $val->storeAs('public/uploads/product_discription_images', $newFileName);
                                $file_input['created_by'] = auth()->guard('master_admins')->user()->id;
                                $file_input['created_ip_address'] = $request->ip();
                                $file_input['product_discription_image'] = ''.$path;
                                $file_input['product_discription_name'] = $file_name;
                                $file_input['product_id'] = $id;
                                ProductsDescriptionImages::create($file_input);        
                            }
                        }
                    }

                    if(!empty($input_files['gallery_images'])){
                        $path = 'uploads/product_images';
                        $rename = strtolower( str_replace(' ','-',$request->input('product_name'))).'-gallery';
                        $files = $request->file('gallery_images');
                        $uploadedFiles = $this->uploadFilesWithRename($files, $path,$rename);
                        unset($uploadedFiles['name']);
                        if(!empty($uploadedFiles)){
                                $input_files['gallery_images'] = implode(',',$uploadedFiles);
                                foreach($uploadedFiles as $k => $value){
                                    $gallery_data = [
                                        'product_id' =>$id,
                                        'product_gallery_image' => $value
                                    ];
                                    $gallery_data['created_by'] = auth()->guard('master_admins')->user()->id;
                                    $gallery_data['created_ip_address'] = $request->ip();
                                    ProductsGalleryImages::create($gallery_data);
                                }
                                    
                        }
                    }
                }
                
                return redirect('admin/product')->with('success', 'Product added successfully!');
        }
    }

    public function check_slug_exist(Request $request){   
        $slug_url = $request->slug_url;
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = Products::where('id', '!=', $id)->where('status', '!=', 'delete')->where('slug_url', $request->slug_url)->first();
            
        }else{
            $is_exists = Products::where('status', '!=', 'delete')->where('slug_url', $request->slug_url)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }

    public function check_sub_sub_category_exist(Request $request){   
        $category_id = $request->category_id;
        $sub_sub_category_id = $request->sub_sub_category_id;
        $sub_category_id = $request->sub_category_id;
        $product_name = $request->product_name;

        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            $is_exists = Products::where('id', '!=', $id)->where('status', '!=', 'delete')->where('product_name', $request->product_name)->where('category_id', $request->category_id)->where('sub_sub_category_id', $request->sub_sub_category_id)->where('sub_category_id', $request->sub_category_id)->first();
        }else{
            $is_exists = Products::where('status', '!=', 'delete')->where('product_name', $request->product_name)->where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->where('sub_sub_category_id', $request->sub_sub_category_id)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }

    public function data_table(Request $request){
        $query = Products::where('products.status', '!=', 'delete')
                ->leftJoin('sub_sub_category_masters', 'products.sub_sub_category_id', '=', 'sub_sub_category_masters.id')
                ->leftJoin('sub_category_masters', 'products.sub_category_id', '=', 'sub_category_masters.id')
                ->join('category_masters', 'products.category_id', '=', 'category_masters.id')
                ->join('brands_masters', 'products.brand_id', '=', 'brands_masters.id')
                ->orderBy('products.id', 'DESC')
                ->select(
                    'products.id',
                    'products.product_id', 
                    'products.product_name',
                    'products.slug_url',
                    'products.sku',
                    'products.price',
                    'products.offer_price',
                    'products.meta_title',
                    'products.meta_description',
                    'products.meta_keywords',
                    'products.product_main_image',
                    'products.download_file',
                    'products.gallery_images',
                    'products.description_image',
                    'products.is_gst',
                    'products.gst_id',
                    'products.is_voltage',
                    'products.voltage_id',
                    'products.is_wattage',
                    'products.wattage_id',
                    'products.is_iprate',
                    'products.iprate_id',
                    'products.description',
                    'products.specification',
                    'products.status', 
                    'brand_name',
                    'sub_sub_category_masters.sub_sub_category_name',
                    'sub_category_masters.sub_category_name', 
                    'category_masters.category_name'
                );

            // Add filters here
            if ($request->filled('category_id')) {
                $query->where('products.category_id', $request->category_id);
            }

            if ($request->filled('sub_category_id')) {
                $query->where('products.sub_category_id', $request->sub_category_id);
            }

            if ($request->filled('sub_sub_category_id')) {
                $query->where('products.sub_sub_category_id', $request->sub_sub_category_id);
            }

            $table_data = $query->get(); // Keep this after filtering


        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return !empty($row->category_name) ? $row->category_name : '' ;
                })
                ->addColumn('product_id', function ($row) {
                    return !empty($row->product_id) ? $row->product_id : '' ;
                })
                ->addColumn('product_name', function ($row) {
                    return !empty($row->product_name) ? $row->product_name : '' ;
                })
                ->addColumn('price', function ($row) {
                    return !empty($row->price) ? $row->price : '' ;
                })
                ->addColumn('brand_name', function ($row) {
                    return !empty($row->brand_name) ? $row->brand_name : '' ;
                })
                ->addColumn('sku', function ($row) {
                    return !empty($row->sku) ? $row->sku : '' ;
                })
                // ->addColumn('sub_category_name', function ($row) {
                //     return !empty($row->sub_category_name) ? $row->sub_category_name : '' ;
                // })
                // ->addColumn('sub_sub_category_name', function ($row) {
                //     return !empty($row->sub_sub_category_name) ? $row->sub_sub_category_name : '' ;
                // })
                
                // ->addColumn('sub_sub_category_image', function ($row) {
                    
                //     $url= !empty($row->sub_sub_category_image) ?url('/').Storage::url($row->sub_sub_category_image) : asset('package_assets/images/default-images/default.png') ;
                //     return '<img width="80px" height="80px" src="'.$url.'" alt="image">';
                // })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/product/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    if($row->status == 'active'){
                    $actionBtn .= ' <a href="'.url('').'/product-detail/'.$row['slug_url'].'" target="_blank" class="btn btn-info btn-sm">
                                                 <i class="fa-regular fa-eye"></i></a>';
                    }else{
                        $actionBtn .= ' <a href="javascript:void;" class="btn btn-secondary btn-sm">
                                                 <i class="fa-regular fa-eye"></i></a>';
                    }
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="products" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="products" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="products" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;" ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:;" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title="Inactive"></></a>';
                            return $statusBlockBtn;
                        }
                    
                })
                ->rawColumns(['sub_sub_category_image','action', 'status'])
                ->make(true);
        }
    }
    
    public function edit($id){
        $edit_data = Products::where('status','!=','delete')->where('id',Crypt::decrypt($id))->first();
        
        if(!empty($edit_data->controller_product_ids)){
            $controller_products = Products::where('status','!=','delete')
                                        ->select('id','product_id','sku','product_name','sku','price','offer_price')
                                        ->whereIn('id',explode(',',$edit_data->controller_product_ids))
                                        ->get();
        }
        $controller_product_list = !empty($controller_products)?$controller_products:'';
        $edit_gallery_images = ProductsGalleryImages::where('product_id',Crypt::decrypt($id))->where('status','active')->select("id","product_id","product_gallery_image")->get();
        $edit_description_images = ProductsDescriptionImages::where('product_id',Crypt::decrypt($id))->where('status','active')->select("id","product_id","product_discription_name","product_discription_image")->get();
        $edit_pdf_files = ProductsPdfFiles::where('product_id',Crypt::decrypt($id))->where('status','active')->select("id","product_id","product_pdf_file_name","product_pdf_file")->get();
        //$edit_parameter = ProductsParameterData::where('product_id',Crypt::decrypt($id))->where('status','active')->select("product_id","parameter_name_id","product_parameter_value_id")->get();

        // For parameter_name_ids
        $edit_parameter_name_ids = ProductsParameterData::where('product_id', Crypt::decrypt($id))
            ->where('status', 'active')
            ->select(DB::raw("GROUP_CONCAT(parameter_name_id) as parameter_name_ids"))
            ->first()
            ->parameter_name_ids;

        // For parameter_value_ids
        $edit_parameter_value_ids = ProductsParameterData::where('product_id', Crypt::decrypt($id))
            ->where('status', 'active')
            ->select(DB::raw("GROUP_CONCAT(parameter_value_id) as parameter_value_ids"))
            ->first()
            ->parameter_value_ids;

        $parameter_list = ProductParameterMaster::where('status','=','active')->select('id','product_parameter_name')->where('status','active')->get();
        foreach($parameter_list as $k => $val){
            $val->param_values = ProductParameterValueMaster::where('product_parameter_id',$val->id)
                                    ->where('status','active')
                                    ->select('id','product_parameter_value','product_parameter_id')
                                    ->get();
        }
       // return $parameter_list;
        $gst_list = GstMaster::where('status','=','active')->get();
        $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        $sub_category_list = SubCategoryMaster::where('status', '=', 'active')->orderBy('sub_category_name','asc')->where('category_id',$edit_data->category_id)->select('id', 'sub_category_name')->get();
        
        if(!empty($edit_data->sub_category_id)){
           $sub_sub_category_list = SubSubCategoryMaster::where('status', '=', 'active')->orderBy('sub_sub_category_name','asc')->select('id', 'sub_sub_category_name')->where('sub_category_id',$edit_data->sub_category_id)->get();
        }else{
            $sub_sub_category_list = SubSubCategoryMaster::where('status', '=', 'active')->orderBy('sub_sub_category_name','asc')->select('id', 'sub_sub_category_name')->get();
        }

        $brand_list = BrandsMaster::where('status', '=', 'active')->orderBy('brand_name','asc')->select('id', 'brand_name')->get();        
        //return $edit_pdf_files;
        return view('Admin.Product.add-product', compact('edit_data','category_list','sub_category_list','sub_sub_category_list','brand_list','gst_list','edit_gallery_images','edit_description_images','edit_pdf_files','edit_parameter_name_ids','edit_parameter_value_ids','parameter_list','controller_product_list'));
    }

    public function DeleteGalleryImage($id){
        $id = Crypt::decrypt($id);
        $gallery_data['status'] = 'delete';
        $gallery_data['created_by'] = auth()->guard('master_admins')->user()->id;
        ProductsGalleryImages::where('id',$id)->update($gallery_data);
        return redirect()->back()->with('success', 'Gallery Image Deleted Successfully!');
    }

    public function DeleteProductPdf($id){
        $id = Crypt::decrypt($id);
        $up_data['status'] = 'delete';
        $up_data['created_by'] = auth()->guard('master_admins')->user()->id;
        ProductsPdfFiles::where('id',$id)->update($up_data);
        return redirect()->back()->with('success', 'Pdf file Deleted Successfully!');
    }

    public function DeleteProductDescriptionImage($id){
        $id = Crypt::decrypt($id);
        $up_data['status'] = 'delete';
        $up_data['created_by'] = auth()->guard('master_admins')->user()->id;
        ProductsDescriptionImages::where('id',$id)->update($up_data);
        return redirect()->back()->with('success', 'Description Image Deleted Successfully!');
    }
    
    // public function data_table_extra_tab(Request $request){
    //     $query = Products::where('products.status', '!=', 'delete')
    //             ->leftJoin('sub_sub_category_masters', 'products.sub_sub_category_id', '=', 'sub_sub_category_masters.id')
    //             ->leftJoin('sub_category_masters', 'products.sub_category_id', '=', 'sub_category_masters.id')
    //             ->join('category_masters', 'products.category_id', '=', 'category_masters.id')
    //             ->join('brands_masters', 'products.brand_id', '=', 'brands_masters.id')
    //             ->orderBy('products.id', 'DESC')
    //             ->select(
    //                 'products.id',
    //                 'products.product_id', 
    //                 'products.product_name',
    //                 'products.sku',
    //                 'products.price',
    //                 'products.offer_price',
                    
    //                 //'sub_sub_category_masters.sub_sub_category_name',
    //                 //'sub_category_masters.sub_category_name', 
    //                 //'category_masters.category_name'
    //             );

    //         // Add filters here
    //         if ($request->filled('category_id')) {
    //             $query->where('products.category_id', $request->category_id);
    //         }

    //         if ($request->filled('sub_category_id')) {
    //             $query->where('products.sub_category_id', $request->sub_category_id);
    //         }

    //         if ($request->filled('sub_sub_category_id')) {
    //             $query->where('products.sub_sub_category_id', $request->sub_sub_category_id);
    //         }

    //         $table_data = $query->get(); // Keep this after filtering


    //     if ($request->ajax()) {
    //         return DataTables::of($table_data)
    //             ->addIndexColumn()
    //             ->addColumn('pid', function ($row) {
    //                 $box = '<input type="checkbox" class="row_checkbox" value="'.$row->id.'" name="controller_products[]">';
    //                 return !empty($row->id) ? $box : '' ;
    //             })
    //             ->addColumn('category_name', function ($row) {
    //                 return !empty($row->category_name) ? $row->category_name : '' ;
    //             })
    //             ->addColumn('product_id', function ($row) {
    //                 return !empty($row->product_id) ? $row->product_id : '' ;
    //             })
    //             ->addColumn('product_name', function ($row) {
    //                 return !empty($row->product_name) ? $row->product_name : '' ;
    //             })
    //             ->addColumn('sku', function ($row) {
    //                 return !empty($row->sku) ? $row->sku : '' ;
    //             })
    //             ->addColumn('price', function ($row) {
    //                 return !empty($row->price) ? $row->price : '' ;
    //             })
    //             ->addColumn('offer_price', function ($row) {
    //                 return !empty($row->offer_price) ? $row->offer_price : '' ;
    //             })
                
    //             ->rawColumns(['pid'])
    //             ->make(true);
    //     }
    // }

     public function data_table_extra_tab(Request $request){
        $query = Products::where('products.status', '!=', 'delete')
                ->leftJoin('sub_sub_category_masters', 'products.sub_sub_category_id', '=', 'sub_sub_category_masters.id')
                ->leftJoin('sub_category_masters', 'products.sub_category_id', '=', 'sub_category_masters.id')
                ->join('category_masters', 'products.category_id', '=', 'category_masters.id')
                ->join('brands_masters', 'products.brand_id', '=', 'brands_masters.id')
                ->orderBy('products.id', 'DESC')
                ->select(
                    'products.id',
                    'products.product_id', 
                    'products.product_name',
                    'products.sku',
                    'products.price',
                    'products.offer_price',
                    
                    //'sub_sub_category_masters.sub_sub_category_name',
                    //'sub_category_masters.sub_category_name', 
                    //'category_masters.category_name'
                );

            // Add filters here
            if ($request->filled('category_id')) {
                $query->where('products.category_id', $request->category_id);
            }

            if ($request->filled('sub_category_id')) {
                $query->where('products.sub_category_id', $request->sub_category_id);
            }

            if ($request->filled('sub_sub_category_id')) {
                $query->where('products.sub_sub_category_id', $request->sub_sub_category_id);
            }
            $controller_product_ids = !empty($request->controller_product_ids)?explode(',',$request->controller_product_ids):array();
            $table_data = $query->get(); // Keep this after filtering
            $html = '';
            if(!empty($table_data)){
                foreach($table_data as $key =>$value){
                    $checked = '';
                    if(in_array($value->id,$controller_product_ids)){
                        $checked = 'checked';
                    }
                    $html .='<tr>
                                <td>'.($key+1).'</td>
                                <td><input type="checkbox" '.$checked.' class="row_checkbox" value="'.$value->id.'" name="controller_products[]"></td>
                                <td>'.$value->product_id.'</td>
                                <td>'.$value->product_name.'</td>
                                <td>'.$value->sku.'</td>
                                <td>'.$value->price.'</td>
                                <td>'.$value->offer_price.'</td>
                            </tr>';
                }
            }
            
            if($html==''){
                $html ='<tr>
                    <td colspan="7">
                    No Data Found
                    </td>
                </tr>';
            }

             return response()->json([
                'status' => 200,
                'data' => $html,
            ]);
        
    }

    public function DeleteProductFromCart(Request $request){
        $product_id = $request->id;
        if(!empty($product_id)){
            CartProduct::where('product_id', $product_id)
                        ->delete();
            UserWishlist::where('product_id', $product_id)
                        ->delete();
        }
    }
}
