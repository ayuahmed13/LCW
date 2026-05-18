<?php

namespace App\Http\Controllers\Products;

use App\Models\Cart;
use App\Models\Products;
use App\Models\CartProduct;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use App\Models\ProductsPdfFiles;
use Illuminate\Support\Facades\DB;
use App\Models\StockManagementData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\CategoryMaster;
use App\Models\ProductsGalleryImages;
use App\Models\ProductsParameterData;
use App\Models\Master\SubCategoryMaster;
use App\Models\ProductsDescriptionImages;
use App\Models\Master\SubSubCategoryMaster;
use App\Models\Master\ProductParameterMaster;

class FrontProductsController extends Controller
{
    public function AllProducts(Request $request)
    {
       $categories_list = CategoryMaster::where('status', 'active')
            ->select(
                'id',
                'category_image',
                'category_name',
                'slug',
                DB::raw('(
                    SELECT COUNT(*) 
                    FROM products 
                    WHERE products.category_id = category_masters.id 
                    AND products.status = "active"
                ) as product_count')
            )
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('Front.products',compact('categories_list'));
        
    }


    public function CategoryWiseProduct(Request $request, $categorySlug)
    {
        $pageNo = $request->get('page_no', 1);
        $limit = 20;
        $offset = ($pageNo - 1) * $limit;
        
        $availability = $request->availability;
        $product_parameter_value_id_arr = array();
        $product_parameter_name_id_arr = array();
        $parameter_filter = $request->parameter_filter;
        if(!empty($parameter_filter)){
            foreach($parameter_filter as $k => $value){
                $parts = explode("??#", $value);
                array_push($product_parameter_name_id_arr,$parts[0]);
                array_push($product_parameter_value_id_arr,$parts[1]);
            }
        }

        $categories_tree_sidebar = CategoryMaster::withCount('products') // direct category-level products
            ->with(['subCategories' => function ($query) {
                $query->select('id', 'category_id', 'sub_category_name', 'slug')
                    ->where('status', 'active')
                    ->withCount('products') // direct subcategory-level products
                    ->with(['subSubCategories' => function ($subQuery) {
                        $subQuery->select('id', 'sub_category_id', 'sub_sub_category_name', 'slug')
                                ->where('status', 'active')
                                ->withCount('products'); // direct sub-subcategory-level products
                    }]);
            }])
            ->select('id', 'category_name', 'slug')
            ->where('status', 'active')
            ->get();

        $category_id_by_slug = CategoryMaster::where('slug', $categorySlug)
                        ->where('status', 'active')
                        ->select('id','category_name','category_description')
                        ->first();
                        if (empty($category_id_by_slug->id)) {
                            return redirect()->back()->with('error', 'Category not found');
                        }        
        $category_data = $category_id_by_slug;

        $category_id = $category_id_by_slug->id;
        
        $sub_category_list = SubCategoryMaster::where('category_id', $category_id_by_slug->id)
                            ->where('status', 'active')
                            ->select('id', 'sub_category_name', 'sub_category_image', 'slug')
                            ->withCount(['products as products_count' => function ($query) {
                                $query->where('status', 'active');
                            }])
                            ->get();

        
        // Get products with limit and offset
        // $product_list = Products::where('status', 'active')
        //                     ->where('sub_category_id', $category_id)
        //                     ->select(
        //                         'id',
        //                         'slug_url', 
        //                         'product_name', 
        //                         'product_main_image', 
        //                         'price', 'offer_price',
        //                         'status','category_id','sub_category_id',
        //                         'sub_sub_category_id'
        //                         )
        //                     ->where('is_available', 'available')
        //                     //->offset($offset)
        //                     //->limit($limit)
        //                     ->orderBy('id','desc')
        //                     ->paginate(12);

        $sort = $request->sort;

        // $product_list_query = Products::where('products.status', 'active')
        //     ->where('category_id', $category_id)
        //     ->select(
        //         'products.id',
        //         'products.slug_url', 
        //         'products.product_name', 
        //         'products.product_main_image', 
        //         'products.price',
        //         'products.is_available',
        //         'products.current_stock', 
        //         'products.offer_price',
        //         'products.status',
        //         'products.category_id',
        //         'products.sub_category_id',
        //         'products.sub_sub_category_id'
        //     )
        //     ->where('is_available', 'available');
            
        //     if(!empty($availability)){
        //         if($availability=='instock'){
        //             $product_list_query->where('products.current_stock','>',0);
        //         }else if($availability=='outstock'){
        //             //$product_list_query->where('products.current_stock','<=',0);
        //             $product_list_query->where(function($query) {
        //                 $query->where('products.current_stock', '<=', 0)
        //                     ->orWhere('products.current_stock', '=', '');
        //             });
        //         }
        //     }
        //     if(!empty($parameter_filter)){
        //         $product_list_query->leftJoin('products_parameter_data', 'products_parameter_data.product_id', '=', 'products.id');
        //         $product_list_query->whereIn('parameter_value_id',$product_parameter_value_id_arr);
        //         //$product_list_query->groupBy('products_parameter_data.product_id');
                
        //     }
        // // Apply sorting based on $sort
        // if (!empty($sort)) {
        //     if ($sort == 'az') {
        //         $product_list_query->orderBy('product_name', 'asc');
        //     } elseif ($sort == 'za') {
        //         $product_list_query->orderBy('product_name', 'desc');
        //     }elseif ($sort == 'prlh') {
        //         $product_list_query->orderBy('offer_price', 'asc');
        //     }elseif ($sort == 'prhl') {
        //         $product_list_query->orderBy('offer_price', 'desc');
        //     } else {
        //         $product_list_query->orderBy('products.id', 'desc'); // default sort
        //     }
        // } else {
        //     $product_list_query->orderBy('products.id', 'desc'); // default sort
        // }

        // $product_list = $product_list_query->paginate(12);
        
        $product_list_query = Products::where('products.status', 'active')
                ->where('products.category_id', $category_id)
                ->where('products.is_available', 'available')
                ->select(
                    'products.id',
                    'products.slug_url',
                    'products.product_name',
                    'products.product_main_image',
                    'products.price',
                    'products.is_available',
                    'products.current_stock',
                    'products.offer_price',
                    'products.status',
                    'products.category_id',
                    'products.sub_category_id',
                    'products.sub_sub_category_id'
                );

            // Stock availability filter
            if (!empty($availability)) {
                if ($availability === 'instock') {
                    $product_list_query->where('products.current_stock', '>', 0);
                } elseif ($availability === 'outstock') {
                    $product_list_query->where(function ($query) {
                        $query->where('products.current_stock', '<=', 0)
                            ->orWhereNull('products.current_stock');
                    });
                }
            }

            // Parameter filtering
            if (!empty($parameter_filter) && !empty($product_parameter_value_id_arr)) {
                $product_list_query->leftJoin(
                    'products_parameter_data',
                    'products_parameter_data.product_id',
                    '=',
                    'products.id'
                )->whereIn('products_parameter_data.parameter_value_id', $product_parameter_value_id_arr);

                // Optional: avoid duplicates if multiple parameter values match same product
                $product_list_query->groupBy(
                    'products.id',
                    'products.slug_url',
                    'products.product_name',
                    'products.product_main_image',
                    'products.price',
                    'products.is_available',
                    'products.current_stock',
                    'products.offer_price',
                    'products.status',
                    'products.category_id',
                    'products.sub_category_id',
                    'products.sub_sub_category_id'
                );
            }

            // Sorting logic
            switch ($sort ?? '') {
                case 'az':
                    $product_list_query->orderBy('products.product_name', 'asc');
                    break;
                case 'za':
                    $product_list_query->orderBy('products.product_name', 'desc');
                    break;
                case 'prlh':
                    $product_list_query->orderBy('products.offer_price', 'asc');
                    break;
                case 'prhl':
                    $product_list_query->orderBy('products.offer_price', 'desc');
                    break;
                default:
                    $product_list_query->orderBy('products.id', 'desc'); // Default sort
                    break;
            }

            // Pagination
            $product_list = $product_list_query->paginate(12);

        $product_ids = $product_list->pluck('id')->toArray();

        if(!empty($product_ids)){
            $parameter_name_ids = ProductsParameterData::whereIn('product_id',$product_ids)->select('parameter_name_id')->get();
            $param_ids = $parameter_name_ids->pluck('parameter_name_id')->toArray();
            $parameters = ProductParameterMaster::with(['values' => function($query) {
                $query->select('id', 'product_parameter_id', 'product_parameter_value');
              	$query->where('status','active');
            }])
            ->select('id', 'product_parameter_name')
            ->whereIn('id',$param_ids)
            ->where('status','active')
            ->orderBy('product_parameter_name','asc')
            ->get();
      
        }else{
            $parameters = '';
        }
       
        $user_id = Auth::guard('master_users')->id();
        // check product incart
        if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){
                $cart_id = $cart->id;
                $productIds = CartProduct::where('cart_id', $cart_id)
                         ->where('status', 'active')
                         ->pluck('product_id')
                         ->toArray();
            }
        }
        $cart_product_ids = !empty($productIds)?$productIds:'';
        // check product inwishlist
        if(!empty($user_id)){
            $product_ids_list = UserWishlist::where('status', 'active')
                    ->where('user_id', $user_id)
                    ->pluck('product_id')
                    ->toArray();
        }
        $wishlist_product_ids = !empty($product_ids_list)?$product_ids_list:'';
        
        $product_outof_stock = Products::where('status', 'active')
            ->where('category_id', $category_id)
            ->where(function($query) {
                $query->where('current_stock', '')
                    ->orWhere('current_stock', '0')
                    ->orWhere('current_stock', 0);
            })
            
            ->where('is_available', 'available')
            ->select('id', 'current_stock');

        $product_outstock = $product_outof_stock->count();

        $product_in_stock = Products::where('status', 'active')
            ->where('current_stock','>', 0)
            ->where('category_id', $category_id)
            ->where('is_available', 'available')
            ->select('id', 'current_stock');

        $product_instock = $product_in_stock->count();
        
        $parent_category_slug = '';
        $sub_parent_category_slug = '';

        $category_typec = 'category';
        $category_slugc = $categorySlug;
        return view('Front.product-categories',compact('parent_category_slug','sub_parent_category_slug','availability','product_parameter_value_id_arr','product_outstock','product_instock','category_slugc','category_typec','product_list','category_id','categorySlug','sub_category_list','category_data','parameters','categories_tree_sidebar','wishlist_product_ids','cart_product_ids'));
    }

    public function SubCategoryWiseProduct(Request $request, $SubcategorySlug)
    {
        
        $pageNo = $request->get('page_no', 1);
        $limit = 20;
        $offset = ($pageNo - 1) * $limit;
        $availability = $request->availability;
        $product_parameter_value_id_arr = array();
        $product_parameter_name_id_arr = array();
        $parameter_filter = $request->parameter_filter;
        if(!empty($parameter_filter)){
            foreach($parameter_filter as $k => $value){
                $parts = explode("??#", $value);
                array_push($product_parameter_name_id_arr,$parts[0]);
                array_push($product_parameter_value_id_arr,$parts[1]);
            }
        }
        $categories_tree_sidebar = CategoryMaster::withCount('products') // direct category-level products
            ->with(['subCategories' => function ($query) {
                $query->select('id', 'category_id', 'sub_category_name', 'slug')
                    ->where('status', 'active')
                    ->withCount('products') // direct subcategory-level products
                    ->with(['subSubCategories' => function ($subQuery) {
                        $subQuery->select('id', 'sub_category_id', 'sub_sub_category_name', 'slug')
                                ->where('status', 'active')
                                ->withCount('products'); // direct sub-subcategory-level products
                    }]);
            }])
            ->select('id', 'category_name', 'slug')
            ->where('status', 'active')
            ->get();

        $sub_category_id_by_slug = SubCategoryMaster::where('slug', $SubcategorySlug)
                        ->where('status', 'active')
                        ->select('id','category_id','sub_category_name','sub_category_description')
                        ->first();
                        if (empty($sub_category_id_by_slug->id)) {
                            return redirect()->back()->with('error', 'Category not found');
                        }        
        $sub_category_data = $sub_category_id_by_slug;

        $category_id = $sub_category_id_by_slug->category_id;
        
        $sub_sub_category_list = SubSubCategoryMaster::where('sub_category_id', $sub_category_id_by_slug->id)
                                ->where('status', 'active')
                                ->select('id', 'sub_sub_category_name', 'sub_sub_category_image', 'slug')
                                ->withCount(['products as products_count' => function ($query) {
                                    $query->where('status', 'active');
                                }])
                                ->get();


        $sub_category_id = $sub_category_id_by_slug->id;

        $sort = $request->sort;

        // $product_list_query = Products::where('products.status', 'active')
        //     ->where('sub_category_id', $sub_category_id)
        //     ->select(
        //         'products.id',
        //         'products.slug_url', 
        //         'products.product_name', 
        //         'products.product_main_image', 
        //         'products.price',
        //         'products.is_available',
        //         'products.current_stock', 
        //         'products.offer_price',
        //         'products.status',
        //         'products.category_id',
        //         'products.sub_category_id',
        //         'products.sub_sub_category_id'
        //     )
            
        //     ->where('is_available', 'available');

        //     if(!empty($availability)){
        //         if($availability=='instock'){
        //             $product_list_query->where('products.current_stock','>',0);
        //         }else if($availability=='outstock'){
        //             //$product_list_query->where('products.current_stock','<=',0);
        //             $product_list_query->where(function($query) {
        //                 $query->where('products.current_stock', '<=', 0)
        //                     ->orWhere('products.current_stock', '=', '');
        //             });
        //         }
        //     }
        //     if(!empty($parameter_filter)){
        //         $product_list_query->leftJoin('products_parameter_data', 'products_parameter_data.product_id', '=', 'products.id');
        //         $product_list_query->whereIn('parameter_value_id',$product_parameter_value_id_arr);
        //         //$product_list_query->groupBy('products_parameter_data.product_id');
                
        //     }
        // // Apply dynamic sorting
        // if (!empty($sort)) {
        //     if ($sort == 'az') {
        //         $product_list_query->orderBy('product_name', 'asc');
        //     } elseif ($sort == 'za') {
        //         $product_list_query->orderBy('product_name', 'desc');
        //     }elseif ($sort == 'prlh') {
        //         $product_list_query->orderBy('offer_price', 'asc');
        //     }elseif ($sort == 'prhl') {
        //         $product_list_query->orderBy('offer_price', 'desc');
        //     } else {
        //         $product_list_query->orderBy('products.id', 'desc'); // default sort
        //     }
        // } else {
        //     $product_list_query->orderBy('products.id', 'desc'); // default sort
        // }
       
        // $product_list = $product_list_query->paginate(12);
        
        $product_list_query = Products::where('products.status', 'active')
                ->where('products.sub_category_id', $sub_category_id)
                ->where('products.is_available', 'available')
                ->select(
                    'products.id',
                    'products.slug_url', 
                    'products.product_name', 
                    'products.product_main_image', 
                    'products.price',
                    'products.is_available',
                    'products.current_stock', 
                    'products.offer_price',
                    'products.status',
                    'products.category_id',
                    'products.sub_category_id',
                    'products.sub_sub_category_id'
                );

            // Stock availability filtering
            if (!empty($availability)) {
                if ($availability == 'instock') {
                    $product_list_query->where('products.current_stock', '>', 0);
                } elseif ($availability == 'outstock') {
                    $product_list_query->where(function ($query) {
                        $query->where('products.current_stock', '<=', 0)
                            ->orWhereNull('products.current_stock')
                            ->orWhere('products.current_stock', '');
                    });
                }
            }

            // Parameter-based filtering
            if (!empty($parameter_filter) && !empty($product_parameter_value_id_arr)) {
                $product_list_query->leftJoin('products_parameter_data', 'products_parameter_data.product_id', '=', 'products.id')
                    ->whereIn('products_parameter_data.parameter_value_id', $product_parameter_value_id_arr)
                    ->groupBy(
                        'products.id',
                        'products.slug_url',
                        'products.product_name',
                        'products.product_main_image',
                        'products.price',
                        'products.is_available',
                        'products.current_stock',
                        'products.offer_price',
                        'products.status',
                        'products.category_id',
                        'products.sub_category_id',
                        'products.sub_sub_category_id'
                    );
            }

            // Sorting
            switch ($sort ?? '') {
                case 'az':
                    $product_list_query->orderBy('products.product_name', 'asc');
                    break;
                case 'za':
                    $product_list_query->orderBy('products.product_name', 'desc');
                    break;
                case 'prlh':
                    $product_list_query->orderBy('products.offer_price', 'asc');
                    break;
                case 'prhl':
                    $product_list_query->orderBy('products.offer_price', 'desc');
                    break;
                default:
                    $product_list_query->orderBy('products.id', 'desc');
                    break;
            }

            // Pagination
            $product_list = $product_list_query->paginate(12);

        $product_ids = $product_list->pluck('id')->toArray();

        if(!empty($product_ids)){
            $parameter_name_ids = ProductsParameterData::whereIn('product_id',$product_ids)->select('parameter_name_id')->where('status','active')->get();
            $param_ids = $parameter_name_ids->pluck('parameter_name_id')->toArray();
            
            $parameters = ProductParameterMaster::with(['values' => function($query) {
                $query->select('id', 'product_parameter_id', 'product_parameter_value');
              	$query->where('status','active');
            }])
            ->select('id', 'product_parameter_name')
            ->whereIn('id',$param_ids)
            ->where('status','active')
            ->orderBy('product_parameter_name','asc')
            ->get();

           

        }else{
            $parameters = '';
        }
        $user_id = Auth::guard('master_users')->id();
        // check product incart
        if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){
                $cart_id = $cart->id;
                $productIds = CartProduct::where('cart_id', $cart_id)
                         ->where('status', 'active')
                         ->pluck('product_id')
                         ->toArray();
            }
        }
        $cart_product_ids = !empty($productIds)?$productIds:'';
        // check product inwishlist
        if(!empty($user_id)){
            $product_ids_list = UserWishlist::where('status', 'active')
                    ->where('user_id', $user_id)
                    ->pluck('product_id')
                    ->toArray();
        }
        $wishlist_product_ids = !empty($product_ids_list)?$product_ids_list:'';
        
        $product_outof_stock = Products::where('status', 'active')
            ->where('sub_category_id', $sub_category_id)
            ->where(function($query) {
                $query->where('current_stock', '')
                    ->orWhere('current_stock', '0')
                    ->orWhere('current_stock', 0);
            })
            
            ->where('is_available', 'available')
            ->select('id', 'current_stock');

        $product_outstock = $product_outof_stock->count();

        $product_in_stock = Products::where('status', 'active')
            ->where('current_stock','>', 0)
            ->where('sub_category_id', $sub_category_id)
            ->where('is_available', 'available')
            ->select('id', 'current_stock');

        $product_instock = $product_in_stock->count();
        
        $tmp_cat_data = CategoryMaster::where(['status'=>'active','id'=>$category_id])->select('slug')->first();
        $parent_category_slug = !empty($tmp_cat_data->slug)?$tmp_cat_data->slug:'';
        $sub_parent_category_slug = $SubcategorySlug;
        $category_typec = 'sub_category';
        $category_slugc = $SubcategorySlug;
        return view('Front.product-categories',compact('parent_category_slug','sub_parent_category_slug','availability','product_parameter_value_id_arr','product_instock','product_outstock','category_slugc','category_typec','product_list','category_id','SubcategorySlug','sub_sub_category_list','sub_category_data','parameters','categories_tree_sidebar','wishlist_product_ids','cart_product_ids'));
    }

    public function SubSubCategoryWiseProduct(Request $request, $SubSubcategorySlug)
    {
       
        // Get page number from GET parameters, default to 1 if not provided
        $pageNo = $request->get('page_no', 1);
        $limit = 20;
        $offset = ($pageNo - 1) * $limit;
       
        $availability = $request->availability;
        $product_parameter_value_id_arr = array();
        $product_parameter_name_id_arr = array();
        $parameter_filter = $request->parameter_filter;
        if(!empty($parameter_filter)){
            foreach($parameter_filter as $k => $value){
                $parts = explode("??#", $value);
                array_push($product_parameter_name_id_arr,$parts[0]);
                array_push($product_parameter_value_id_arr,$parts[1]);
            }
        }

        $categories_tree_sidebar = CategoryMaster::withCount('products') // direct category-level products
                ->with(['subCategories' => function ($query) {
                    $query->select('id', 'category_id', 'sub_category_name', 'slug')
                        ->where('status', 'active')
                        ->withCount('products') // direct subcategory-level products
                        ->with(['subSubCategories' => function ($subQuery) {
                            $subQuery->select('id', 'sub_category_id', 'sub_sub_category_name', 'slug')
                                    ->where('status', 'active')
                                    ->withCount('products'); // direct sub-subcategory-level products
                        }]);
                }])
                ->select('id', 'category_name', 'slug')
                ->where('status', 'active')
                ->get();

        $sub_sub_category_id_by_slug = SubSubCategoryMaster::where('slug', $SubSubcategorySlug)
                        ->where('status', 'active')
                        ->select('id','category_id','sub_category_id','sub_sub_category_name as sub_category_name')
                        ->first();
                        if (empty($sub_sub_category_id_by_slug->id)) {
                            return redirect()->back()->with('error', 'Category not found');
                        }        
        $sub_category_data = $sub_sub_category_id_by_slug;

        $category_id = $sub_sub_category_id_by_slug->category_id;

        $sub_category_id = $sub_sub_category_id_by_slug->sub_category_id;
        
        $sub_sub_category_id = $sub_sub_category_id_by_slug->id;

       
        $sort = $request->sort;

        // $product_list_query = Products::where('products.status', 'active')
        //     ->where('sub_sub_category_id', $sub_sub_category_id)
        //     ->select(
        //        'products.id',
        //         'products.slug_url', 
        //         'products.product_name', 
        //         'products.product_main_image', 
        //         'products.price',
        //         'products.is_available',
        //         'products.current_stock', 
        //         'products.offer_price',
        //         'products.status',
        //         'products.category_id',
        //         'products.sub_category_id',
        //         'products.sub_sub_category_id'
        //     )
        //     ->where('is_available', 'available');

        // // Apply sorting logic
        // if (!empty($sort)) {
        //     if ($sort == 'az') {
        //         $product_list_query->orderBy('product_name', 'asc');
        //     } elseif ($sort == 'za') {
        //         $product_list_query->orderBy('product_name', 'desc');
        //     }elseif ($sort == 'prlh') {
        //         $product_list_query->orderBy('offer_price', 'asc');
        //     }elseif ($sort == 'prhl') {
        //         $product_list_query->orderBy('offer_price', 'desc');
        //     } else {
        //         $product_list_query->orderBy('products.id', 'desc'); // default sort
        //     }
        // } else {
        //     $product_list_query->orderBy('products.id', 'desc'); // default sort
        // }

        // $product_list = $product_list_query->paginate(12);
        
        $product_list_query = Products::where('products.status', 'active')
                ->where('products.sub_sub_category_id', $sub_sub_category_id)
                ->where('products.is_available', 'available')
                ->select(
                    'products.id',
                    'products.slug_url',
                    'products.product_name',
                    'products.product_main_image',
                    'products.price',
                    'products.is_available',
                    'products.current_stock',
                    'products.offer_price',
                    'products.status',
                    'products.category_id',
                    'products.sub_category_id',
                    'products.sub_sub_category_id'
                );

            // Filter by stock availability
            if (!empty($availability)) {
                if ($availability === 'instock') {
                    $product_list_query->where('products.current_stock', '>', 0);
                } elseif ($availability === 'outstock') {
                    $product_list_query->where(function ($query) {
                        $query->where('products.current_stock', '<=', 0)
                            ->orWhereNull('products.current_stock');
                    });
                }
            }

            // Filter by parameters (if applied)
            if (!empty($parameter_filter) && !empty($product_parameter_value_id_arr)) {
                $product_list_query->leftJoin('products_parameter_data', 'products_parameter_data.product_id', '=', 'products.id')
                    ->whereIn('products_parameter_data.parameter_value_id', $product_parameter_value_id_arr)
                    ->groupBy(
                        'products.id',
                        'products.slug_url',
                        'products.product_name',
                        'products.product_main_image',
                        'products.price',
                        'products.is_available',
                        'products.current_stock',
                        'products.offer_price',
                        'products.status',
                        'products.category_id',
                        'products.sub_category_id',
                        'products.sub_sub_category_id'
                    );
            }

            // Sorting
            switch ($sort ?? '') {
                case 'az':
                    $product_list_query->orderBy('products.product_name', 'asc');
                    break;
                case 'za':
                    $product_list_query->orderBy('products.product_name', 'desc');
                    break;
                case 'prlh':
                    $product_list_query->orderBy('products.offer_price', 'asc');
                    break;
                case 'prhl':
                    $product_list_query->orderBy('products.offer_price', 'desc');
                    break;
                default:
                    $product_list_query->orderBy('products.id', 'desc'); // Default
                    break;
            }

            // Pagination
            $product_list = $product_list_query->paginate(12);

        $product_ids = $product_list->pluck('id')->toArray();

        if(!empty($product_ids)){
            $parameter_name_ids = ProductsParameterData::whereIn('product_id',$product_ids)->select('parameter_name_id')->get();
            $param_ids = $parameter_name_ids->pluck('parameter_name_id')->toArray();
            $parameters = ProductParameterMaster::with(['values' => function($query) {
                $query->select('id', 'product_parameter_id', 'product_parameter_value');
              	$query->where('status','active');
            }])
            ->select('id', 'product_parameter_name')
            ->whereIn('id',$param_ids)
            ->where('status','active')
            ->orderBy('product_parameter_name','asc')
            ->get();
      
        }else{
            $parameters = '';
        }
        // check product incart
        // check product in wishlist
        $user_id = Auth::guard('master_users')->id();
        if(!empty($user_id)){
            $product_ids_list = UserWishlist::where('status', 'active')
                    ->where('user_id', $user_id)
                    ->pluck('product_id')
                    ->toArray();
        }
        $wishlist_product_ids = !empty($product_ids_list)?$product_ids_list:'';
        
        $product_outof_stock = Products::where('status', 'active')
            ->where('sub_sub_category_id', $sub_sub_category_id)
            ->where(function($query) {
                $query->where('current_stock', '')
                    ->orWhere('current_stock', '0')
                    ->orWhere('current_stock', 0);
            })
            
            ->where('is_available', 'available')
            ->select('id', 'current_stock');

        $product_outstock = $product_outof_stock->count();

        $product_in_stock = Products::where('status', 'active')
            ->where('current_stock','>', 0)
            ->where('sub_sub_category_id', $sub_sub_category_id)
            ->where('is_available', 'available')
            ->select('id', 'current_stock');

        $product_instock = $product_in_stock->count();

        $tmp_cat_data = CategoryMaster::where(['status'=>'active','id'=>$category_id])->select('slug')->first();
        $parent_category_slug = !empty($tmp_cat_data->slug)?$tmp_cat_data->slug:'-';
        
        $tmp_scat_data = SubCategoryMaster::where(['status'=>'active','id'=>$sub_category_id])->select('slug')->first();
        $sub_parent_category_slug = !empty($tmp_scat_data->slug)?$tmp_scat_data->slug:'';
        
        $category_typec = 'sub_sub_category';
        $category_slugc = $SubSubcategorySlug;
        return view('Front.product-categories',compact('parent_category_slug','sub_parent_category_slug','availability','product_parameter_value_id_arr','product_outstock','product_instock','category_slugc','category_typec','product_list','category_id','SubSubcategorySlug','sub_category_data','parameters','categories_tree_sidebar','wishlist_product_ids'));
    }
    public function productDetails($slug){
        
        $product_details = Products::where('products.status', 'active')
                ->where('products.slug_url', $slug)
                ->join('category_masters', 'products.category_id', '=', 'category_masters.id')
                ->join('brands_masters', 'products.brand_id', '=', 'brands_masters.id')
                ->leftJoin('sub_category_masters', 'products.sub_category_id', '=', 'sub_category_masters.id')
                ->leftJoin('sub_sub_category_masters', 'products.sub_sub_category_id', '=', 'sub_sub_category_masters.id')
                ->select(
                    'products.id',
                    'products.slug_url', 
                    'products.product_name', 
                    'products.product_main_image', 
                    'products.price', 
                    'description','specification',
                    'products.offer_price',
                    'products.status',
                    'products.sku',
                    'products.current_stock',
                    'products.is_available',
                    'products.category_id',
                    'products.sub_category_id',
                    'products.sub_sub_category_id',
                    'brands_masters.brand_name',
                    'category_masters.category_name',
                    'sub_category_masters.sub_category_name',
                    'sub_sub_category_masters.sub_sub_category_name',
                    'short_description',
                    'extra_tab',
                    'tab_name',
                    'controller_product_ids',
                    'meta_title', 'meta_keywords', 'meta_description'
                )
                ->where('is_available', 'available')
                ->where('category_masters.status', 'active')
                ->where('brands_masters.status', 'active')
                ->first();

        if(empty($product_details)){
            return redirect()->back()->with('error','Product not found.');
        }
        $id = $product_details->id;
     
        $product_details->product_gallery_images = ProductsGalleryImages::where('product_id',$id)->where('status','active')->select("id","product_id","product_gallery_image")->get();
        $product_details->product_description_images = ProductsDescriptionImages::where('product_id',$id)->where('status','active')->select("id","product_id","product_discription_name","product_discription_image")->get();
        $product_details->product_pdf_files = ProductsPdfFiles::where('product_id',$id)->where('status','active')->select("id","product_id","product_pdf_file_name","product_pdf_file")->get();
        $stock_data = StockManagementData::where('product_id',$id)->where('status','active')->select("id","product_id","current_stock")->first();
        $product_details->product_stock = !empty($stock_data->current_stock)?$stock_data->current_stock:0;
        
        // controller_products
        if(!empty($product_details->extra_tab) && $product_details->extra_tab=='yes'){
            if(!empty($product_details->controller_product_ids)){
                $controller_products = Products::where('status','active')
                                            ->whereIn('id',explode(',',$product_details->controller_product_ids))
                                            ->select(
                                                    'products.id',
                                                    'products.slug_url', 
                                                    'products.product_name', 
                                                    'products.product_main_image', 
                                            )
                                            ->get();
            }
        }
        $controller_product_list = !empty($controller_products)?$controller_products:'';
        // Related Products

        $product_details->related_products = Products::where('status', 'active')
                                            ->where('id','!=', $id)
                                            ->where('sub_category_id', $product_details->sub_category_id)
                                            ->select(
                                                'id',
                                                'slug_url', 
                                                'product_name', 
                                                'product_main_image', 
                                                'price', 'offer_price',
                                                'status','category_id','sub_category_id',
                                                'sub_sub_category_id',
                                                'current_stock',
                                                'is_available'
                                                )
                                            ->where('is_available', 'available')
                                            ->orderBy('id','desc')
                                            ->limit(4)
                                            ->get();
        //return $product_details;
        $user_id = Auth::guard('master_users')->id();
        if(!empty($user_id)){
            $product_ids_list = UserWishlist::where('status', 'active')
                    ->where('user_id', $user_id)
                    ->pluck('product_id')
                    ->toArray();
           
        }
        $wishlist_product_ids = !empty($product_ids_list)?$product_ids_list:'';
         if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){
                $cart_id = $cart->id;
                $productIds = CartProduct::where('cart_id', $cart_id)
                         ->where('status', 'active')
                         ->pluck('product_id')
                         ->toArray();
                 $cart_product_details = CartProduct::where('cart_id', $cart_id)
                         ->where('status', 'active')
                         ->select('product_qty')
                         ->get();
                $product_details->qty = !empty($cart_product_details->product_qty)?$cart_product_details->product_qty:1;
            }
        }else{
            $sscart = session('cart', []);
            if(!empty($sscart)){
                $product_details->qty = isset($sscart[$id]["quantity"]) ? $sscart[$id]["quantity"] : 1;
            }
        }
        $cart_product_ids = !empty($productIds)?$productIds:'';

        return view('Front.product-detail',compact('product_details','wishlist_product_ids','cart_product_ids','controller_product_list'));
    }

    public function ProductSearchResult(Request $request)
    {
        $is_search = 1;
        $q=$request->q;
        if(empty($q)){
            return redirect()->back()->with('error','No input received for search.');
        }
        $sort = $request->sort;
        // Get products with limit and offset
        
        $product_list_query = Products::where('status', 'active')
        ->where('product_name', 'like', '%'.$q.'%')
        ->where('is_available', 'available')
        ->select(
            'id',
            'slug_url', 
            'product_name', 
            'product_main_image', 
            'price', 
            'offer_price',
            'status',
            'category_id',
            'sub_category_id',
            'sub_sub_category_id',
            'current_stock',
            'is_available'
        );

    // Apply sorting based on user selection
    if (!empty($sort)) {
        if ($sort == 'az') {
            $product_list_query->orderBy('product_name', 'asc');
        } elseif ($sort == 'za') {
            $product_list_query->orderBy('product_name', 'desc');
        } elseif ($sort == 'prlh') {
            $product_list_query->orderBy('offer_price', 'asc');
        } elseif ($sort == 'prhl') {
            $product_list_query->orderBy('offer_price', 'desc');
        } else {
            $product_list_query->orderBy('id', 'desc'); // default sort
        }
    } else {
        $product_list_query->orderBy('id', 'desc'); // default sort
    }

    // Fetch paginated products
    $product_list = $product_list_query->paginate(12);

        $product_ids = $product_list->pluck('id')->toArray();

        if(!empty($product_ids)){
            $parameter_name_ids = ProductsParameterData::whereIn('product_id',$product_ids)->where('status','active')->select('parameter_name_id')->get();
            $param_ids = $parameter_name_ids->pluck('parameter_name_id')->toArray();
            $parameters = ProductParameterMaster::with(['values' => function($query) {
                $query->select('id', 'product_parameter_id', 'product_parameter_value');
                $query->where('status','active');
            }])
            ->select('id', 'product_parameter_name')
            ->whereIn('id',$param_ids)
            ->where('status','active')
            ->orderBy('product_parameter_name','asc')
            ->get();
      
        }else{
            $parameters = '';
        }
        $user_id = Auth::guard('master_users')->id();
        // check product incart
        if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){
                $cart_id = $cart->id;
                $productIds = CartProduct::where('cart_id', $cart_id)
                         ->where('status', 'active')
                         ->pluck('product_id')
                         ->toArray();
            }
        }
        $cart_product_ids = !empty($productIds)?$productIds:'';
        // check product inwishlist
        if(!empty($user_id)){
            $product_ids_list = UserWishlist::where('status', 'active')
                    ->where('user_id', $user_id)
                    ->pluck('product_id')
                    ->toArray();
        }
        $wishlist_product_ids = !empty($product_ids_list)?$product_ids_list:'';
        return view('Front.product-categories',compact('product_list','wishlist_product_ids','cart_product_ids','q','is_search'));
    }

    public function getParameterWiseCount(Request $request)
    {
        $pid = $request->pid; // array from AJAX
        $vid = $request->vid; // array from AJAX
        $category_type = $request->category_type;
        $category_slug = $request->category_slug;
        if(!empty($category_type)){
            if($category_type=='category'){
                $cat_id = CategoryMaster::where('status','active')
                                ->where('slug',$category_slug)
                                ->select('id')
                                ->first();
            }else if($category_type=='sub_category'){
                $cat_id = SubCategoryMaster::where('status','active')
                                ->where('slug',$category_slug)
                                ->select('id')
                                ->first();
            }else if($category_type=='sub_category'){
                $cat_id = SubSubCategoryMaster::where('status','active')
                                ->where('slug',$category_slug)
                                ->select('id')
                                ->first();
            }

        }
        $category_id = !empty($cat_id->id)?$cat_id->id:'';
        if (!empty($pid) && !empty($vid)) {
       
        // $data = DB::table('products_parameter_data as ppd')
        //     ->join('products as p', 'ppd.product_id', '=', 'p.id')
        //     ->select('ppd.parameter_value_id', DB::raw('COUNT(ppd.id) as products_count'))
        //     ->where('ppd.status', 'active')
        //     ->where('p.status', 'active')
        //     ->groupBy('ppd.parameter_value_id')
        //     //->groupBy('ppd.parameter_name_id')
        //     //->groupBy('ppd.product_id')
        //     ->get();

        $data = DB::table('products_parameter_data as ppd')
            ->join('products as p', 'ppd.product_id', '=', 'p.id')
            ->select('ppd.parameter_value_id', DB::raw('COUNT(ppd.id) as products_count'))
            ->where('ppd.status', 'active')
            ->where('p.status', 'active');

        if (!empty($category_id)) {
            if ($category_type == 'category') {
                $data->where('p.category_id', $category_id);
            } else if ($category_type == 'sub_category') {
                $data->where('p.sub_category_id', $category_id);
            } else if ($category_type == 'sub_sub') {
                $data->where('p.sub_sub_id', $category_id);
            }
        }

        $data = $data->groupBy('ppd.parameter_value_id')->get();


            return response()->json($data);
        } else {
            return response()->json([
                'error' => 'Invalid or missing parameters'
            ], 400);
        }
    }
}

