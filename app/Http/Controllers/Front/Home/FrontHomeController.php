<?php

namespace App\Http\Controllers\Front\Home;

use App\Models\Cart;
use App\Models\FaqData;
use App\Models\Products;
use App\Models\AboutUsCms;
use App\Models\CartProduct;
use App\Models\HomeCmsData;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use App\Models\OrderProducts;
use App\Models\ShowcaseImages;
use App\Models\PageContentCmsData;
use Illuminate\Support\Facades\DB;
use App\Models\AboutUsTestimonials;
use App\Models\Master\BrandsMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\CategoryMaster;

class FrontHomeController extends Controller
{
    public function index(){
   
        $user_id = Auth::guard('master_users')->id();
      
        $homeCms = HomeCmsData::where('status','active')->first();
        $showcase = ShowcaseImages::where('status','active')->orderBy('id','desc')->get();
        $brands = BrandsMaster::where('status','active')->select('id','brand_image')->orderBy('id','desc')->get(); 
        $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name','slug','category_image')->get();
        $product_list = Products::where('status', 'active')
                            ->select(
                                'id',
                                'slug_url', 
                                'product_name', 
                                'product_main_image', 
                                'price', 'offer_price',
                                'current_stock',
                                'status'
                                )
                            ->where('is_available', 'available')
                            ->orderBy('id','desc')
                            ->limit(8)
                            ->get();

        $best_selling_products_data = OrderProducts::select('product_id', DB::raw('count(id) as total'))
            ->where('status', 'active')
            ->groupBy('product_id')
            ->orderBy('total','desc')
            ->limit(6)
            ->get();
        $productIds = $best_selling_products_data->pluck('product_id')->toArray();
        $best_selling_products = Products::where('status', 'active')
                            ->select(
                                'id',
                                'slug_url', 
                                'product_name', 
                                'product_main_image', 
                                'price', 'offer_price',
                                'current_stock',
                                'status'
                                )
                            ->whereIn('id',!empty($productIds)?$productIds:array())
                            ->where('is_available', 'available')
                            ->orderBy('id','desc')
                            ->limit(6)
                            ->get();                  
        // check product incart
        if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){
                $cart_id = $cart->id;
                $cproductIds = CartProduct::where('cart_id', $cart_id)
                         ->where('status', 'active')
                         ->pluck('product_id')
                         ->toArray();
            }
        }
        $cart_product_ids = !empty($cproductIds)?$cproductIds:'';
        // check product inwishlist
        if(!empty($user_id)){
            $product_ids_list = UserWishlist::where('status', 'active')
                    ->where('user_id', $user_id)
                    ->pluck('product_id')
                    ->toArray();
        }
        $wishlist_product_ids = !empty($product_ids_list)?$product_ids_list:'';
        
        return view('Front.index',compact('homeCms','showcase','category_list','product_list','brands','best_selling_products','cart_product_ids','wishlist_product_ids','best_selling_products'));
    }

    public function AboutUsCms(Request $request){
        $homeCms = HomeCmsData::where('status','active')->first();

        $about_us_cms = AboutUsCms::where('status','active')->first();
        $testimonials = AboutUsTestimonials::where('status','active')->orderBy('id','desc')->get();
        return view('Front.about',compact('about_us_cms','testimonials','homeCms'));
    }

    public function PrivacyPolicyCms(Request $request){
        $data = PageContentCmsData::where('status','active')->where('page','Privacy Policy')->first();
        return view('Front.privacy-policy',compact('data'));
    }

    public function TermsConditionsCms(Request $request){
        $data = PageContentCmsData::where('status','active')->where('page','Terms and Conditions')->first();
        return view('Front.terms-conditions',compact('data'));
    }
    
    public function GlossaryCms(Request $request){
        $data = PageContentCmsData::where('status','active')->where('page','Grossary')->first();
        return view('Front.glossary',compact('data'));
    }

    public function ProductBrandCms(Request $request){
        $data = PageContentCmsData::where('status','active')->where('page','Product Brand Information')->first();
        return view('Front.brand-information',compact('data'));
    }

    public function FrontFaq(Request $request){
        $data = FaqData::where('status','active')->select('question','answer')->orderBy('id','desc')->get();
        return view('Front.FAQs',compact('data'));
    }
    
}
