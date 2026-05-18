@section('meta-header')
@section('title', !empty($product_details->meta_title) ? $product_details->meta_title : 'LCW Lighting')
@section('meta_description', !empty($product_details->meta_description) ? $product_details->meta_description : '')
@section('meta_keywords', !empty($product_details->meta_keywords) ? $product_details->meta_keywords : '')
@include ('Front.includes.header')
<style>
    .empty-cart {
        height: auto !important;
    }
    .cart-img {
        height: 100% !important;
        object-fit: cover
    }
    .tf-sticky-btn-atc .tf-sticky-atc-product .image {
    width: 70px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
}
.tf-add-cart-success {
        height: auto !important;
}
</style>
<!-- breadcrumb -->
{{-- <div class="tf-breadcrumb" style=" background-color:#f4f3ee">
            <div class="container">
                <div class="tf-breadcrumb-wrap">
                    <div class="tf-breadcrumb-list">
                        <a href="{{ url('') }}" class="text text-caption-1">Home</a>
<i class="icon icon-arrRight"></i>
<a href="#" class="text text-caption-1">Lighting</a>
<i class="icon icon-arrRight"></i>
<span class="text text-caption-1">lighting</span>
</div>
<div class="tf-breadcrumb-prev-next">
    <a class="tf-breadcrumb-prev">
        <i class="icon icon-arrLeft"></i>
    </a>
    <a class="tf-breadcrumb-back">
        <i class="icon icon-squares-four"></i>
    </a>
    <a class="tf-breadcrumb-next">
        <i class="icon icon-arrRight"></i>
    </a>
</div>
</div>
</div>
</div> --}}
<!-- /breadcrumb -->

<!-- page-title -->
<div class="page-title"
    style="background-image: url('{{ asset('front/images/products/new-images/terms-top-banner-image.png') }}'); background-color:#f4f3ee">

    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Product details</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>

                    <li>
                        Product details
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- tf-add-cart-success -->
<div class="tf-add-cart-success">
    <div class="tf-add-cart-heading">
        <h5>Shopping Cart</h5>
        <i class="icon icon-close tf-add-cart-close"></i>
    </div>
    <div class="tf-add-cart-product">
        <div class="image">
            <img id="modal-prod-img" class="lazyload img-product" data-src="{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                src="{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : URL::asset('front/images/default-img.jpg') }}" alt="image-product">
        </div>
        <div class="content">
            <div class="text-title">
                <a id="modal-prod-name" class="link" href="{{ url('product-detail') }}/{{!empty($product_details->slug_url)?$product_details->slug_url:''}}">{{!empty($product_details->product_name)?$product_details->product_name:''}}</a>
            </div>
            <div id="modal-prod-category" class="text-caption-1 text-secondary-2">{{!empty($product_details->category_name)?$product_details->category_name:''}}</div>
            <div id="modal-prod-offer-price" class="text-title">${{!empty($product_details->offer_price)?$product_details->offer_price:''}}</div>
        </div>
    </div>
    <a href="{{ url('shopping-cart') }}" class="tf-btn w-100 btn-fill radius-4"><span
            class="text text-btn-uppercase">View cart</span></a>
</div>
<!-- /tf-add-cart-success -->
@php
$tus = Auth::guard('master_users')->id();
if(empty($tus)){
$cart = session('cart', []);
}
@endphp
<!-- Product_Main -->
<section class="flat-spacing">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <!-- Product default -->
                <div class="col-lg-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <div class="thumbs-slider">
                            <div class="gallery-container">
                                <!-- Thumbnails -->
                                <div class="thumbnail-list">

                                    <img src="{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                        class="active" alt="{{!empty($product_details->product_name)?$product_details->product_name:''}}"
                                        onclick="changeImage(this, '{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : URL::asset('front/images/default-img.jpg') }}')">
                                    @if(!empty($product_details->product_gallery_images))
                                    @foreach($product_details->product_gallery_images as $k => $image)
                                    <img src="{{ !empty($image->product_gallery_image) && Storage::exists($image->product_gallery_image) ? url('/').Storage::url($image->product_gallery_image) : '' }}"
                                        alt="{{!empty($product_details->product_name)?$product_details->product_name:''}}"
                                        onclick="changeImage(this, '{{ !empty($image->product_gallery_image) && Storage::exists($image->product_gallery_image) ? url('/').Storage::url($image->product_gallery_image) : URL::asset('front/images/default-img.jpg') }}')">
                                    @endforeach
                                    @endif
                                </div>

                                <!-- Main Image -->
                                <div class="main-image">
                                    <img id="mainDisplay"
                                        src="{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                        alt="{{!empty($product_details->product_name)?$product_details->product_name:''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="tf-product-media-wrap sticky-top">
                                <div class="thumbs-slider">
                                    <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                        <div class="swiper-wrapper stagger-wrap">
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="image-product">
                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="gray">
                <div class="item">
                    <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="image-product">
                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="gray">
                <div class="item">
                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">

                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="gray">
                <div class="item">
                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="beige">
                <div class="item">
                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="beige">
                <div class="item">
                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="beige">
                <div class="item">
                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="grey">
                <div class="item">
                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </div>
            </div>
            <div class="swiper-slide stagger-item" data-color="grey">
                <div class="item">
                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
        <div class="swiper-wrapper">
            <div class="swiper-slide" data-color="gray">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="gray">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="gray">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="gray">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="beige">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="beige">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="beige">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="grey">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
            <div class="swiper-slide" data-color="grey">
                <a href="{{URL::asset('front/images/products/new-images/LED-1.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED-1.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="">
                </a>
            </div>
        </div>
    </div>
    </div>
    </div> --}}
    {{-- <div class="gallery-container">
                                <!-- Thumbnails -->
                                <div class="thumbnail-list">
                                  <img src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" class="active" alt="Thumbnail 1" onclick="changeImage(this, 'front/images/products/new-images/LED-1.png')">
    <img src="{{URL::asset('front/images/products/new-images/best-sell-1.jpg')}}" alt="Thumbnail 2" onclick="changeImage(this, 'front/images/products/new-images/best-sell-1.jpg')">
    <img src="{{URL::asset('https://www.est.net.in/wp-content/uploads/2020/05/LED-Track-Light-FS4039-30-Image.jpg')}}" alt="Thumbnail 3" onclick="changeImage(this, 'https://www.est.net.in/wp-content/uploads/2020/05/LED-Track-Light-FS4039-30-Image.jpg')">
    <img src="{{URL::asset('https://5.imimg.com/data5/SELLER/Default/2024/9/454425618/DM/XE/AG/9484000/30-watt-led-track-light.jpg')}}" alt="Thumbnail 4" onclick="changeImage(this, 'https://5.imimg.com/data5/SELLER/Default/2024/9/454425618/DM/XE/AG/9484000/30-watt-led-track-light.jpg')">
    <img src="{{URL::asset('https://grnled.com/wp-content/uploads/2024/02/three-phase-Track-lighting.jpg.webp')}}" alt="Thumbnail 5" onclick="changeImage(this, 'https://grnled.com/wp-content/uploads/2024/02/three-phase-Track-lighting.jpg.webp')">
    <img src="{{URL::asset('https://dothelight.com/wp-content/uploads/2023/09/12w-zoomable-led-track-lighting-for-museum-247x300.png')}}" alt="Thumbnail 6" onclick="changeImage(this, 'https://dothelight.com/wp-content/uploads/2023/09/12w-zoomable-led-track-lighting-for-museum-247x300.png')">
    </div>

    <!-- Main Image -->
    <div class="main-image">
        <img id="mainDisplay" src="{{URL::asset('front/images/products/new-images/LED-1.png')}}" alt="Main Display">
    </div>
    </div> --}}
    </div>
    <!-- /Product default -->
    <!-- tf-product-info-list -->
    <div class="col-lg-6">
        <div class="tf-product-info-wrap position-relative">
            <div class="tf-zoom-main"></div>
            <div class="tf-product-info-list other-image-zoom">
                <div class="tf-product-info-heading">
                    <div class="tf-product-info-name">
                        
                        <div class="text text-btn-uppercase">{{!empty($product_details->brand_name)?$product_details->brand_name:''}}</div>
                        <h3 class="name">{{!empty($product_details->product_name)?$product_details->product_name:''}}</h3>
                    </div>
                    <div class="tf-product-info-desc">
                        <div class="tf-product-info-price">
                            <h5 class="price-on-sale font-2">${{!empty($product_details->offer_price)?$product_details->offer_price:''}}</h5>
                            @if($product_details->offer_price!=$product_details->price)
                            <div class="compare-at-price font-2">${{!empty($product_details->price)?$product_details->price:''}}</div>
                            @endif
                            @if($product_details->offer_price!=$product_details->price)
                            <div class="badges-on-sale text-btn-uppercase">
                                @php
                                $discount_percentage = (($product_details->price - $product_details->offer_price) / $product_details->price) * 100;
                                
                                echo $discount_percentage = round($discount_percentage*(-1), 2).'%';
                                
                                @endphp

                            </div>
                            @endif
                            <div class="tf-product-info-choose-option" style="display: none;">
                                <div class="variant-picker-item">

                                    <div id="stock-display" class="mt-2 fw-medium text-stock">{{!empty($product_details->product_stock)?$product_details->product_stock:0}} in stock</div>
                                </div>
                                <div class="tf-product-info-quantity">
                                    <div class="title mb_12">Quantity:</div>
                                    <div class="row g-2">
                                        <div class="wg-quantity col-4">
                                            <span class="btn-quantity btn-decrease {{!empty($incart)?'qty-minus':'qty-minus1'}}" data-min="1" data-max="{{!empty($product_details->current_stock)?$product_details->current_stock:0}}">-</span>
                                            <input class="quantity-product product-qty-inp " type="text" name="product-qty" id="product-qty"
                                                value="{{!empty($product_details->qty)?$product_details->qty:1}}" >
                                            <span class="btn-quantity btn-increase {{!empty($incart)?'qty-plus':'qty-plus1'}}" data-max="{{!empty($product_details->current_stock)?$product_details->current_stock:0}}" data-min="1">+</span>
                                        </div>
                                        <div class="tf-product-info-by-btn mb_10 col-8 col-sm-5">
                                @if((!empty($cart_product_ids) && in_array($product_details->id,$cart_product_ids)) || (empty($tus) && !empty($cart) && $inCart = array_key_exists($product_details->id, $cart)))
                                    <a href="{{url('/')}}/shopping-cart" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart go-to-cart ar-cart-div"
                                                data-product-id="{{ !empty($product_details->id)?$product_details->id:''}}"
                                                data-product-name="{{ !empty($product_details->product_name)?$product_details->product_name:''}}"
                                                data-product-price="{{ !empty($product_details->offer_price)?$product_details->offer_price:''}}"
                                                data-product-qty="{{ !empty($product_details->qty)?$product_details->qty:1}}"
                                    data-product-stock="{{ !empty($product_details->current_stock)?$product_details->current_stock:0}}"

                                    >
                                                <span>Go To Cart -&nbsp;</span>
                                                <span class="tf-qty-price total-price">${{!empty($product_details->offer_price)?$product_details->offer_price:''}}</span>
                                            </a>
                                @else
                                    <a href="#shoppingCart" data-bs-toggle="modal"
                                                class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart add-to-cart ar-cart-div"
                                                
                                                data-product-id="{{ !empty($product_details->id)?$product_details->id:''}}"
                                                data-product-name="{{ !empty($product_details->product_name)?$product_details->product_name:''}}"
                                                data-product-price="{{ !empty($product_details->offer_price)?$product_details->offer_price:''}}"
                                                data-product-qty="{{ !empty($product_details->qty)?$product_details->qty:1}}"
                                                data-product-stock="{{ !empty($product_details->current_stock)?$product_details->current_stock:0}}"
                                                
                                                >
                                                <span>Add to cart -&nbsp;</span>
                                                <span class="tf-qty-price total-price">${{!empty($product_details->offer_price)?$product_details->offer_price:''}}</span>
                                    </a>
                                @endif
                                
                                        </div>
                                    </div>
                                </div>
                                <ul class="tf-product-info-sku">
                                    <li>
                                        <p class="text-caption-1">SKU:</p>
                                        <p class="text-caption-1 text-1">
                                        {{!empty($product_details->sku)?$product_details->sku:''}}
                                        </p>
                                    </li>
                                    <li>
                                        <p class="text-caption-1">Categories:</p>
                                        <p class="text-caption-1 text-1">
                                        {{!empty($product_details->category_name)?$product_details->category_name:''}}
                                        </p>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <p>{!! !empty($product_details->short_description)?$product_details->short_description:'' !!}</p>
                    </div>
                </div>
                <div class="pb-3">


                    <!-- Row 2: App Control and Third Party Control -->
                    @if(!empty($product_details->product_description_images ))
                    <div class="row g-4">
                        <!-- App Control -->
                        @foreach($product_details->product_description_images as $k => $value)
                        <div class="col-md-6">
                            <div class="control-box">
                                <div class="fw-medium">{{!empty($value->product_description_name)?$value->product_description_name:''}}</div>
                                <div class="icon-group d-flex  flex-wrap">
                                    <img src="{{ !empty($value->product_discription_image) ? url('/').Storage::url($value->product_discription_image) : '' }}"
                                        alt="{{!empty($product_details->product_name)?$product_details->product_name:''}}">

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
                <div class="tf-product-info-choose-option">
                    <div class="variant-picker-item">

                        <div id="stock-display" class="mt-2 fw-medium text-stock">{{!empty($product_details->product_stock)?$product_details->product_stock:'0'}} in stock</div>
                    </div>
                    <div class="tf-product-info-quantity">
                        <div class="title mb_12">Quantity:</div>
                        <div class="row g-2">
                            <div class="wg-quantity col-4">
                                 @php
                                    if((!empty($cart_product_ids) && in_array($product_details->id,$cart_product_ids)) || (empty($tus) && !empty($cart) && $inCart = array_key_exists($product_details->id, $cart))){
                                        $incart = 'yes';
                                    }
                                    @endphp
                                <span class="btn-quantity btn-decrease {{!empty($incart)?'qty-minus':'qty-minus1'}}" data-min="1" data-max="{{!empty($product_details->current_stock)?$product_details->current_stock:0}}">-</span>
                                <input class="quantity-product product-qty-inp main-product-qty" type="text" name="product-qty" id="product-qty"
                                                value="{{!empty($product_details->qty)?$product_details->qty:1}}" >
                                <span class="btn-quantity btn-increase {{!empty($incart)?'qty-plus':'qty-plus1'}}" data-max="{{!empty($product_details->current_stock)?$product_details->current_stock:0}}" data-min="1">+</span>
                                       
                            </div>
                            <div class="tf-product-info-by-btn mb_10 col-8 col-sm-5">
                                @if((!empty($cart_product_ids) && in_array($product_details->id,$cart_product_ids)) || (empty($tus) && !empty($cart) && $inCart = array_key_exists($product_details->id, $cart)))
                                <a href="{{url('/')}}/shopping-cart" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart go-to-cart ar-cart-div"
                                    
                                    data-product-id="{{ !empty($product_details->id)?$product_details->id:''}}"
                                    data-product-name="{{ !empty($product_details->product_name)?$product_details->product_name:''}}"
                                    data-product-price="{{ !empty($product_details->offer_price)?$product_details->offer_price:''}}"
                                    data-product-qty="{{ !empty($product_details->qty)?$product_details->qty:1}}"
                                    data-product-stock="{{ !empty($product_details->current_stock)?$product_details->current_stock:0}}"
                                    
                                    >
                                    <span>Go To Cart -&nbsp;</span>
                                    <span class="tf-qty-price total-price">${{!empty($product_details->offer_price)?$product_details->offer_price:''}}</span>
                                </a>
                                @else
                                <a href="#shoppingCart" data-bs-toggle="modal"
                                    class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart add-to-cart ar-cart-div"
                                    
                                    data-qty-class = "main-product-qty"
                                    data-product-id="{{ !empty($product_details->id)?$product_details->id:''}}"
                                    data-product-name="{{ !empty($product_details->product_name)?$product_details->product_name:''}}"
                                    data-product-price="{{ !empty($product_details->offer_price)?$product_details->offer_price:''}}"
                                    data-product-qty="{{ !empty($product_details->qty)?$product_details->qty:1}}"
                                    data-product-stock="{{ !empty($product_details->current_stock)?$product_details->current_stock:0}}"
                                    
                                    >
                                    <span>Add to cart -&nbsp;</span>
                                    <span class="tf-qty-price total-price">${{!empty($product_details->offer_price)?$product_details->offer_price:''}}</span>
                                </a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <ul class="tf-product-info-sku">
                        <li>
                            <p class="text-caption-1">SKU:</p>
                            <p class="text-caption-1 text-1">
                                {{!empty($product_details->sku)?$product_details->sku:''}}
                            </p>
                        </li>
                        <li>
                            <p class="text-caption-1">Categories:</p>
                            <p class="text-caption-1 text-1">
                                {{!empty($product_details->category_name)?$product_details->category_name:''}}
                            </p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- /tf-product-info-list -->
    </div>
    </div>
    </div>
    <div class="tf-sticky-btn-atc">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form class="form-sticky-atc">
                        <div class="tf-sticky-atc-product">
                            <div class="image">
                                <img class="lazyload cart-img"
                                    data-src="{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    alt="{{!empty($product_details->product_name)?$product_details->product_name:''}}"
                                    src="{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : URL::asset('front/images/default-img.jpg') }}">
                            </div>
                            <div class="content">
                                <div class="text-title">
                                    {{!empty($product_details->product_name)?$product_details->product_name:''}}
                                </div>
                                <div class="text-caption-1 text-secondary-2">{{!empty($product_details->category_name)?$product_details->category_name:''}}</div>
                                <div class="text-title">${{!empty($product_details->offer_price)?$product_details->offer_price:''}}</div>
                            </div>
                        </div>

                        <div class="tf-sticky-atc-infos">

                            <div class="tf-sticky-atc-quantity d-flex gap-12 align-items-center">
                                <div class="tf-sticky-atc-infos-title text-title">Quantity:</div>
                                <div class="wg-quantity style-1">
                                    @php
                                    if((!empty($cart_product_ids) && in_array($product_details->id,$cart_product_ids)) || (empty($tus) && !empty($cart) && $inCart = array_key_exists($product_details->id, $cart))){
                                        $incart = 'yes';
                                    }
                                    @endphp
                                    <span class="btn-quantity minus-btn {{!empty($incart)?'qty-minus':'qty-minus1'}}" data-max="{{!empty($product_details->current_stock)?$product_details->current_stock:0}}" data-min="0">-</span>
                                    <input class="product-qty-inp footer-product-qty" type="text" name="number" id="footer-add-to-cart-input" value="{{!empty($product_details->qty)?$product_details->qty:1}}" data-max="{{!empty($product_details->current_stock)?$product_details->current_stock:0}}">
                                    <span class="btn-quantity plus-btn {{!empty($incart)?'qty-plus':'qty-plus1'}}" data-max="{{!empty($product_details->current_stock)?$product_details->current_stock:0}}" data-min="0">+</span>
                                </div>
                            </div>
                            <div class="tf-sticky-atc-btns">
                                @if((!empty($cart_product_ids) && in_array($product_details->id,$cart_product_ids)) || (empty($tus) && !empty($cart) && $inCart = array_key_exists($product_details->id, $cart)))

                                <a href="{{url('/')}}/shopping-cart"
                                    class="tf-btn w-100 btn-reset radius-4 btn-add-to-cart"><span
                                        class="text text-btn-uppercase foot">Go To Cart</span></a>
                                @else

                                <a href="#shoppingCart" data-bs-toggle="modal"
                                    class="tf-btn w-100 btn-reset radius-4 btn-add-to-cart add-to-cart"
                                    data-qty-class = "footer-product-qty"
                                    data-product-id="{{ !empty($product_details->id)?$product_details->id:''}}"
                                    data-product-name="{{ !empty($product_details->product_name)?$product_details->product_name:''}}"
                                    data-product-price="{{ !empty($product_details->offer_price)?$product_details->offer_price:''}}"
                                    data-product-qty="{{ !empty($product_details->qty)?$product_details->qty:1}}"
                                    data-product-stock="{{ !empty($product_details->current_stock)?$product_details->current_stock:0}}"
                                    data-prod-img = "{{ !empty($product_details->product_main_image) && Storage::exists($product_details->product_main_image) ? url('/').Storage::url($product_details->product_main_image) : '' }}"
                                    ><span
                                        class="text text-btn-uppercase foot">Add To Cart</span></a>
                            @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Product_Main -->

<!-- Product_Description_Tabs -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-tabs style-1">
                    <ul class="widget-menu-tab">
                        <li class="item-title active">
                            <span class="inner">Description</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Specifications</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">

                                {{!empty($product_details->tab_name)?$product_details->tab_name:'Controllers'}}
                            </span>
                        </li>
                        {{-- <li class="item-title">
                                    <span class="inner">Instructions</span>
                                </li>
                                <li class="item-title">
                                    <span class="inner">Notes</span>
                                </li> --}}
                        <li class="item-title">
                            <span class="inner">Downloads</span>
                        </li>

                    </ul>
                    <div class="widget-content-tab pb-5">
                        <div class="widget-content-inner active">
                            <div class="tab-description">
                                <div class="right">
                                    <div class="letter-1 text-btn-uppercase mb_12">
                                        {{!empty($product_details->product_name)?$product_details->product_name:''}}
                                    </div>
                                    <p class="mb_12 text-secondary">
                                        {!! !empty($product_details->description)?$product_details->description:'No Data' !!}
                                    </p>

                                </div>

                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Product Specifications</h5>
                                    </div>
                                    <div class="card-body">
                                        {!! !empty($product_details->specification)?$product_details->specification:'No Data' !!}

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="widget-content-inner">
                            <div class="container-full slider-layout-right wow fadeInUp" data-wow-delay="0.1s">
                                <div class="row">
                                    <!-- 1 -->
                                    @if(!empty($product_details->extra_tab) && $product_details->extra_tab=='yes' && !empty($controller_product_list))
                                    @foreach($controller_product_list as $k => $value)
                                    <div class="col-6 col-md-3 mb-3">
                                        <div class="collection-position-2 hover-img">
                                            <a href="{{ url('product-detail') }}/{{!empty($value->slug_url)?$value->slug_url:''}}" class="img-style">
                                                <img class="lazyload img-fluid" data-src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : '' }}"
                                                    src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : '' }}" alt="banner-cls">
                                            </a>
                                        </div>
                                        <a href="{{ url('product-detail') }}">
                                            <p class="pt-2">
                                                {{!empty($value->product_name)?$value->product_name:''}}
                                            </p>
                                        </a>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="empty-cart text-center mt-4 p-5 text-dark rounded">
                        <h1 class="text-center text-dark">
                        <i class="icon icon-ShoppingBagOpen"></i>
                        </h1>
                        <h4 class="text-center text-dark">
                            
                            No Data Available 
                        </h4>

                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="widget-content-inner">

                            @if(!empty($product_details->product_pdf_files))
                            @foreach($product_details->product_pdf_files as $k => $value)
                            @if(!empty($value->product_pdf_file))
                            <a href="{{ !empty($value->product_pdf_file) ? url('/').Storage::url($value->product_pdf_file) : '' }}"
                                class="dwn btn btn-info" style="width:160px;color:white;font-size:14px"
                                target="_blank" download>
                                <i class="fa fa-download"></i>
                                {{!empty($value->product_pdf_file_name)?$value->product_pdf_file_name:''}}
                            </a>
                            @else
                            <label class="dwn btn btn-secondary" title="File not available" style="width:160px;color:white;font-size:14px">
                                <i class="fa fa-download"></i>
                                Download
                            </label>
                            @endif
                            @endforeach
                            @else
                            <div class="empty-cart text-center mt-4 p-5 text-dark rounded">
                        <h1 class="text-center text-dark">
                        <i class="icon icon-ShoppingBagOpen"></i>
                        </h1>
                        <h4 class="text-center text-dark">
                            
                            No Data Available 
                        </h4>

                        </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Product_Description_Tabs -->

<!-- Ralated Products -->
@if(!empty($product_details->related_products) && count($product_details->related_products))
<section class="flat-spacing">
    <div class="container flat-animate-tab">
        <ul class="tab-product justify-content-sm-center wow fadeInUp" data-wow-delay="0s" role="tablist">
            <li class="nav-tab-item" role="presentation">
                <a href="#ralatedProducts" class="active" data-bs-toggle="tab">Related Products</a>
            </li>
        </ul>
        <div dir="ltr" class="swiper tf-sw-recent" data-preview="4" data-tablet="3" data-mobile="2"
            data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
            data-pagination-lg="1">
            <div class="swiper-wrapper">
                <!-- 1 -->
                @if(!empty($product_details->related_products))
                @foreach($product_details->related_products as $k => $value)
                <div class="swiper-slide">
                    <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url)?$value->slug_url:''}}" class="product-img">
                                <img class="lazyload img-product"
                                    data-src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    alt="{{ !empty($value->product_name) ? $value->product_name : '' }}">
                                <img class="lazyload img-hover"
                                    data-src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    alt="{{ !empty($value->product_name) ? $value->product_name : '' }}">
                            </a>

                            <div class="list-product-btn">
                                @if(!empty($wishlist_product_ids) && in_array($value->id,$wishlist_product_ids))
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action remove-from-wishlist" data-productid="{{ !empty($value->id)?$value->id:''}}" style="background-color: black;color: white;">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Remove</span>
                                </a>
                                @else
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action add-to-wishlist" data-id="{{ !empty($value->id)?Crypt::encrypt($value->id):''}}">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Wishlist</span>
                                </a>
                                @endif
                            </div>
                            <div class="list-btn-main no-cart">
                                @if((!empty($cart_product_ids) && in_array($value->id,$cart_product_ids)) || (empty($tus) && !empty($cart) && $inCart = array_key_exists($value->id, $cart)))
                                <a href="{{url('/')}}/shopping-cart" class="btn-main-product btn btn-primary w-100 go-to-cart"
                                    data-product-id="{{ !empty($value->id)?$value->id:''}}"
                                    data-product-name="{{ !empty($value->product_name)?$value->product_name:''}}"
                                    data-product-price="{{ !empty($value->offer_price)?$value->offer_price:''}}"
                                    data-product-qty="{{ !empty($value->qty)?$value->qty:1}}"
                                    data-product-stock="{{ !empty($value->current_stock)?$value->current_stock:0}}"
                                    >Go To cart</a>
                                @else
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product add-to-cart "
                                    data-product-id="{{ !empty($value->id)?$value->id:''}}"
                                    data-product-name="{{ !empty($value->product_name)?$value->product_name:''}}"
                                    data-product-price="{{ !empty($value->offer_price)?$value->offer_price:''}}"
                                    data-product-stock="{{ !empty($value->current_stock)?$value->current_stock:0}}"
                                    data-product-qty="{{ !empty($value->qty)?$value->qty:1}}"
                                    data-prod-img = "{{ !empty($value->product_main_image) && Storage::exists($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : '' }}" 
                                    >Add To Cart</a>
                                @endif
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url)?$value->slug_url:''}}" class="title link">{{ !empty($value->product_name) ? $value->product_name : '' }}</a>
                            <span class="price">${{ !empty($value->offer_price) ? $value->offer_price : '' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
        </div>

    </div>
</section>
@endif
<!-- /Ralated Products -->

@include ('Front.includes.footer')

<script>
    $(".product").addClass("active");
</script>

<script>
    function changeImage(el, imgSrc) {
        document.getElementById('mainDisplay').src = imgSrc;

        // Remove active class from all thumbnails
        document.querySelectorAll('.thumbnail-list img').forEach(img => {
            img.classList.remove('active');
        });

        // Add active class to clicked one
        el.classList.add('active');
    }

</script>