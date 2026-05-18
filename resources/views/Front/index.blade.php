@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ('Front.includes.header')


<style>
    .tf-marquee {
        overflow: hidden;
        width: 100%;
        position: relative;
        height: 50px;
        /* adjust as needed */
    }

    .marquee-wrapper {
        position: absolute;
        left: 50%;
        /* Start from the center of the screen */
        transform: translateX(0);
        /* Initial position */
        white-space: nowrap;
        animation: scroll-left 30s linear infinite;
    }

    .initial-child-container {
        display: inline-flex;
        align-items: center;
    }

    .marquee-child-item {
        display: inline-flex;
        align-items: center;
        margin-right: 2rem;
        /* spacing between items */
    }

    .text-btn-uppercase {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 16px;
    }

    @keyframes scroll-left {
        0% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .collection-position-2 .img-style img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .modal-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: unset;
        max-width: unset;
    }

    .collection-position-3 a {
        cursor: default !important;
    }

    .title.link {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tf-icon-box {
    justify-content: space-between !important;
    height: 185px !important;
}
</style>

<!-- Slider -->
@if (!empty($homeCms))
    <section class="tf-slideshow slider-style2 slider-effect-fade">
        <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1"
            data-centered="false" data-space="0" data-space-mb="0" data-loop="true" data-auto-play="true">
            <div class="swiper-wrapper">
                @if (!empty($homeCms->section1_heading1))
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ !empty($homeCms->section1_image1) && Storage::exists($homeCms->section1_image1) ? url('/') . Storage::url($homeCms->section1_image1) : '' }}"
                                alt="{{ !empty($homeCms->section1_heading1) ? $homeCms->section1_heading1 : '' }}">
                            <div class="box-content">
                                <div class="container">
                                    <div class="content-slider">
                                        <div class="box-title-slider">
                                            <div class="fade-item fade-item-1 heading title-display">
                                                {{ !empty($homeCms->section1_heading1) ? $homeCms->section1_heading1 : '' }}
                                            </div>
                                            <p class="fade-item fade-item-2 body-text-1">
                                                {{ !empty($homeCms->section1_sub_heading1) ? $homeCms->section1_sub_heading1 : '' }}
                                            </p>
                                        </div>
                                        <div class="fade-item fade-item-3 box-btn-slider">
                                            <a href="{{ !empty($homeCms->section1_button_url1) ? $homeCms->section1_button_url1 : '' }}"
                                                class="tf-btn btn-fill"><span
                                                    class="text">{{ !empty($homeCms->section1_button_name1) ? $homeCms->section1_button_name1 : '' }}</span><i
                                                    class="icon icon-arrowUpRight"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($homeCms->section1_heading2))
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ !empty($homeCms->section1_image2) && Storage::exists($homeCms->section1_image2) ? url('/') . Storage::url($homeCms->section1_image2) : '' }}"
                                alt="{{ !empty($homeCms->section1_heading2) ? $homeCms->section1_heading2 : '' }}">
                            <div class="box-content">
                                <div class="container">
                                    <div class="content-slider">
                                        <div class="box-title-slider">
                                            <div class="fade-item fade-item-1 heading title-display">
                                                {{ !empty($homeCms->section1_heading2) ? $homeCms->section1_heading2 : '' }}
                                            </div>
                                            <p class="fade-item fade-item-2 body-text-1">
                                                {{ !empty($homeCms->section1_sub_heading2) ? $homeCms->section1_sub_heading2 : '' }}
                                            </p>
                                        </div>
                                        <div class="fade-item fade-item-3 box-btn-slider">
                                            <a href="{{ !empty($homeCms->section1_button_url2) ? $homeCms->section1_button_url2 : '' }}"
                                                class="tf-btn btn-fill"><span
                                                    class="text">{{ !empty($homeCms->section1_button_name2) ? $homeCms->section1_button_name2 : '' }}</span><i
                                                    class="icon icon-arrowUpRight"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($homeCms->section1_heading3))
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ !empty($homeCms->section1_image3) && Storage::exists($homeCms->section1_image3) ? url('/') . Storage::url($homeCms->section1_image3) : '' }}"
                                alt="{{ !empty($homeCms->section1_heading3) ? $homeCms->section1_heading3 : '' }}">
                            <div class="box-content">
                                <div class="container">
                                    <div class="content-slider">
                                        <div class="box-title-slider">
                                            <div class="fade-item fade-item-1 heading title-display">
                                                {{ !empty($homeCms->section1_heading3) ? $homeCms->section1_heading3 : '' }}
                                            </div>
                                            <p class="fade-item fade-item-2 body-text-1">
                                                {{ !empty($homeCms->section1_sub_heading3) ? $homeCms->section1_sub_heading3 : '' }}
                                            </p>
                                        </div>
                                        <div class="fade-item fade-item-3 box-btn-slider">
                                            <a href="{{ !empty($homeCms->section1_button_url3) ? $homeCms->section1_button_url3 : '' }}"
                                                class="tf-btn btn-fill"><span
                                                    class="text">{{ !empty($homeCms->section1_button_name3) ? $homeCms->section1_button_name3 : '' }}</span><i
                                                    class="icon icon-arrowUpRight"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="wrap-pagination">
            <div class="container">
                <div class="sw-dots sw-pagination-slider type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
@endif
<!-- /Slider -->
<!-- Marquee -->
@if (!empty($homeCms->section2_marquee_text))
    <!-- <section class="tf-marquee">
    <div class="marquee-wrapper">
        <div class="initial-child-container">
            
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">{{ $homeCms->section2_marquee_text }} </p>
            </div>

            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            
        </div>
    </div>
</section> -->


    <section class="tf-marquee">
        <div class="marquee-wrapper">
            <div class="initial-child-container">
                <div class="marquee-child-item">
                    <p class="text-btn-uppercase">{{ $homeCms->section2_marquee_text }}</p>
                </div>
                <div class="marquee-child-item">
                    <span class="icon icon-lightning-line"></span>
                </div>
                <!-- Repeat for smooth infinite scroll -->
                <div class="marquee-child-item">
                    <p class="text-btn-uppercase">{{ $homeCms->section2_marquee_text }}</p>
                </div>
                <div class="marquee-child-item">
                    <span class="icon icon-lightning-line"></span>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- /Marquee -->
@php
    $tus = Auth::guard('master_users')->id();
    if (empty($tus)) {
        $cart = session('cart', []);
    }
@endphp
<!-- Categories -->
@if (!empty($category_list))
    <section class="flat-spacing">
        <div class="container">
            <div class="heading-section-2 wow fadeInUp">
                <h3 class="heading">Explore By Categories</h3>
                <a href="{{ url('products') }}" class="btn-line">View All Categories</a>
            </div>
        </div>
        <div class="container-full slider-layout-right wow fadeInUp" data-wow-delay="0.1s">
            <div dir="ltr" class="swiper tf-sw-categories" data-preview="6.2" data-tablet="3.2" data-mobile="2.2"
                data-space-lg="20" data-space-md="20" data-space="15" data-pagination="1" data-pagination-md="1"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <!-- 1 -->
                    @foreach ($category_list as $k => $value)
                        <div class="swiper-slide">
                            <div class="collection-position-2 hover-img">
                                <a href="{{ url('product-categories') }}/{{ !empty($value->slug) ? $value->slug : '' }}"
                                    class="img-style">
                                    <img class="lazyload"
                                        data-src="{{ !empty($value->category_image) ? url('/') . Storage::url($value->category_image) : URL::asset('front/images/default-img.jpg') }}"
                                        src="{{ !empty($value->category_image) ? url('/') . Storage::url($value->category_image) : URL::asset('front/images/default-img.jpg') }}"
                                        alt="{{ !empty($value->category_name) ? $value->category_name : '' }}">
                                </a>
                            </div>

                            <a href="{{ url('product-categories') }}/{{ !empty($value->slug) ? $value->slug : '' }}">
                                <p class="pt-2"> {{ !empty($value->category_name) ? $value->category_name : '' }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
<!-- /Categories -->
<!-- Top pick -->
@if (!empty($product_list) && count($product_list))
    <section>
        <div class="container">
            <div class="heading-section text-center wow fadeInUp">
                <h3 class="heading">New Products</h3>
                <p class="subheading text-secondary">Fresh styles just in! Elevate your look.</p>
            </div>
            <div dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2"
                data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    @foreach ($product_list as $key => $value)
                        <div class="swiper-slide">
                            <div class="card-product wow fadeInUp" data-wow-delay="0s">
                                <div class="card-product-wrapper">
                                    <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url) ? $value->slug_url : '' }}"
                                        class="product-img">
                                        <img class="lazyload img-product"
                                            data-src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            alt="{{ !empty($value->product_name) ? '' . $value->product_name : '' }}">
                                        <img class="lazyload img-hover"
                                            data-src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            alt="{{ !empty($value->product_name) ? '' . $value->product_name : '' }}">
                                    </a>
                                    <div class="list-product-btn">
                                        @if (!empty($wishlist_product_ids) && in_array($value->id, $wishlist_product_ids))
                                            <a href="javascript:void(0);"
                                                class="box-icon wishlist btn-icon-action remove-from-wishlist"
                                                data-productid="{{ !empty($value->id) ? $value->id : '' }}"
                                                style="background-color: black;color: white;">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Remove</span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                                class="box-icon wishlist btn-icon-action add-to-wishlist"
                                                data-id="{{ !empty($value->id) ? Crypt::encrypt($value->id) : '' }}">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Wishlist</span>
                                            </a>
                                        @endif

                                    </div>
                                    <div class="list-btn-main">

                                        @if (
                                            (!empty($cart_product_ids) && in_array($value->id, $cart_product_ids)) ||
                                                (empty($tus) && !empty($cart) && ($inCart = array_key_exists($value->id, $cart))))
                                            <a href="{{ url('/') }}/shopping-cart"
                                                class="btn-main-product btn btn-primary w-100 go-to-cart"
                                                data-product-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                data-product-name="{{ !empty($value->product_name) ? $value->product_name : '' }}"
                                                data-product-price="{{ !empty($value->offer_price) ? $value->offer_price : '' }}"
                                                data-product-qty="{{ !empty($value->qty) ? $value->qty : 1 }}">Go To
                                                cart</a>
                                        @else
                                            <a href="#quickAdd" data-bs-toggle="modal"
                                                class="btn-main-product add-to-cart"
                                                data-product-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                data-product-name="{{ !empty($value->product_name) ? $value->product_name : '' }}"
                                                data-product-price="{{ !empty($value->offer_price) ? $value->offer_price : '' }}"
                                                data-product-qty="{{ !empty($value->qty) ? $value->qty : 1 }}"
                                                data-product-stock="{{ !empty($value->current_stock) ? $value->current_stock : 0 }}">Add
                                                To Cart</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ url('product-detail') }}"
                                        class="title link">{{ !empty($value->product_name) ? '' . $value->product_name : '-' }}</a>
                                    <span
                                        class="price">{{ !empty($value->offer_price) ? '$' . $value->offer_price : '-' }}</span>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
@endif
<!-- /Top pick -->
<!-- Banner collection -->
<section class="flat-spacing">
    <div class="container">
        <div dir="ltr" class="swiper tf-sw-collection sw-lookbook-wrap" data-preview="3" data-tablet="2"
            data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
            data-pagination-md="1" data-pagination-lg="1">
            <div class="swiper-wrapper">
                @if (!empty($homeCms->section3_heading1))
                    <div class="swiper-slide">
                        <div class="collection-position-3 hover-img wow fadeInUp" data-wow-delay="0s">
                            <a href="javascript:;" class="img-style">
                                <img class="lazyload"
                                    data-src="{{ !empty($homeCms->section3_image1) && Storage::exists($homeCms->section3_image1) ? url('/') . Storage::url($homeCms->section3_image1) : '' }}"
                                    src="{{ !empty($homeCms->section3_image1) && Storage::exists($homeCms->section3_image1) ? url('/') . Storage::url($homeCms->section3_image1) : '' }}"
                                    alt="{{ $homeCms->section3_heading1 }}">
                            </a>
                            <div class="content">
                                <div class="archive-top">
                                    <h4 class="title"><a href="javascript:;" class="link text-white">
                                            {{ $homeCms->section3_heading1 }}</a></h4>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($homeCms->section3_heading2))
                    <div class="swiper-slide">
                        <div class="collection-position-3 hover-img wow fadeInUp" data-wow-delay="0s">
                            <a href="javascript:;" class="img-style">
                                <img class="lazyload"
                                    data-src="{{ !empty($homeCms->section3_image3) && Storage::exists($homeCms->section3_image3) ? url('/') . Storage::url($homeCms->section3_image3) : '' }}"
                                    src="{{ !empty($homeCms->section3_image3) && Storage::exists($homeCms->section3_image3) ? url('/') . Storage::url($homeCms->section3_image3) : '' }}"
                                    alt="{{ $homeCms->section3_heading2 }}">
                            </a>
                            <div class="content">
                                <div class="archive-top">
                                    <h4 class="title"><a href="javascript:;" class="link text-white">
                                            {{ $homeCms->section3_heading2 }}</a></h4>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($homeCms->section3_heading3))
                    <div class="swiper-slide">
                        <div class="collection-position-3 hover-img wow fadeInUp" data-wow-delay="0s">
                            <a href="javascript:;" class="img-style">
                                <img class="lazyload"
                                    data-src="{{ !empty($homeCms->section3_image1) && Storage::exists($homeCms->section3_image1) ? url('/') . Storage::url($homeCms->section3_image1) : '' }}"
                                    src="{{ !empty($homeCms->section3_image1) && Storage::exists($homeCms->section3_image1) ? url('/') . Storage::url($homeCms->section3_image1) : '' }}"
                                    alt="{{ $homeCms->section3_heading3 }}">
                            </a>
                            <div class="content">
                                <div class="archive-top">
                                    <h4 class="title"><a href="javascript:;" class="link text-white">
                                            {{ $homeCms->section3_heading3 }}</a></h4>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="sw-pagination-collection sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
<!-- /Banner collection -->
<!-- Selling -->
@if (!empty($best_selling_products) && count($best_selling_products))

    <section class="flat-spacing pt-0">
        <div class="container">
            <div class="heading-section text-center wow fadeInUp">
                <h3 class="heading">Best Selling</h3>
                <p class="subheading text-secondary">Browse our Top Trending: the hottest picks loved by all.</p>
            </div>
            <div dir="ltr" class="swiper tf-sw-recent" data-preview="4" data-tablet="3" data-mobile="2"
                data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <!-- 1 -->
                    @foreach ($best_selling_products as $key => $value)
                        <div class="swiper-slide">
                            <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s">
                                <div class="card-product-wrapper">
                                    <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url) ? $value->slug_url : '' }}"
                                        class="product-img">
                                        <img class="lazyload img-product"
                                            data-src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            alt="{{ !empty($value->product_name) ? '' . $value->product_name : '-' }}">
                                        <img class="lazyload img-hover"
                                            data-src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            src="{{ !empty($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                            alt="{{ !empty($value->product_name) ? '' . $value->product_name : '-' }}">
                                    </a>
                                    <div class="list-product-btn">
                                        @if (!empty($wishlist_product_ids) && in_array($value->id, $wishlist_product_ids))
                                            <a href="javascript:void(0);"
                                                class="box-icon wishlist btn-icon-action remove-from-wishlist"
                                                data-productid="{{ !empty($value->id) ? $value->id : '' }}"
                                                style="background-color: black;color: white;">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Remove</span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                                class="box-icon wishlist btn-icon-action add-to-wishlist"
                                                data-id="{{ !empty($value->id) ? Crypt::encrypt($value->id) : '' }}">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Wishlist</span>
                                            </a>
                                        @endif


                                    </div>
                                    <div class="list-btn-main">
                                        @if (
                                            (!empty($cart_product_ids) && in_array($value->id, $cart_product_ids)) ||
                                                (empty($tus) && !empty($cart) && ($inCart = array_key_exists($value->id, $cart))))
                                            <a href="{{ url('/') }}/shopping-cart"
                                                class="btn-main-product btn btn-primary w-100 go-to-cart"
                                                data-product-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                data-product-name="{{ !empty($value->product_name) ? $value->product_name : '' }}"
                                                data-product-price="{{ !empty($value->offer_price) ? $value->offer_price : '' }}"
                                                data-product-qty="{{ !empty($value->qty) ? $value->qty : 1 }}">Go To
                                                cart</a>
                                        @else
                                            <a href="#quickAdd" data-bs-toggle="modal"
                                                class="btn-main-product add-to-cart"
                                                data-product-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                data-product-name="{{ !empty($value->product_name) ? $value->product_name : '' }}"
                                                data-product-price="{{ !empty($value->offer_price) ? $value->offer_price : '' }}"
                                                data-product-qty="{{ !empty($value->qty) ? $value->qty : 1 }}"
                                                data-product-stock="{{ !empty($value->current_stock) ? $value->current_stock : 0 }}">Add
                                                To Cart</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ url('product-detail') }}"
                                        class="title link">{{ !empty($value->product_name) ? '' . $value->product_name : '-' }}</a>
                                    <span
                                        class="price">{{ !empty($value->offer_price) ? '$' . $value->offer_price : '-' }}</span>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
@endif
<!-- /Selling -->
<!-- Banner with text -->
<section>
    <div class="container">
        <div class="flat-img-with-text">
            @if (!empty($homeCms->section4_image2))
                <div class="banner banner-left wow fadeInLeft">
                    <img src="{{ !empty($homeCms->section4_image1) && Storage::exists($homeCms->section4_image1) ? url('/') . Storage::url($homeCms->section4_image1) : '' }}"
                        alt="banner">
                </div>
            @endif
            <div class="banner-content">
                <div class="content-text wow fadeInUp">
                    @if (!empty($homeCms->section4_heading))
                        <h3 class="title text-center fw-5">{{ $homeCms->section4_heading }}</h3>
                    @endif
                    @if (!empty($homeCms->section4_sub_heading))
                        <p class="desc">{{ $homeCms->section4_sub_heading }}</p>
                    @endif
                </div>
                <a href="{{ $homeCms->section4_button_url }}" class="tf-btn btn-fill wow fadeInUp"><span
                        class="text">
                        {{ $homeCms->section4_button_name }}
                    </span><i class="icon icon-arrowUpRight"></i></a>
            </div>
            @if (!empty($homeCms->section4_image2))
                <div class="banner banner-right wow fadeInRight">
                    <img src="{{ !empty($homeCms->section4_image2) && Storage::exists($homeCms->section4_image2) ? url('/') . Storage::url($homeCms->section4_image2) : '' }}"
                        alt="{{ $homeCms->section4_heading }}">
                </div>
            @endif
        </div>
    </div>
</section>
<!-- /Banner with text -->
<!-- Iconbox -->
<section class="flat-spacing">
    <div class="container">
        <div dir="ltr" class="swiper tf-sw-iconbox" data-preview="4" data-tablet="3" data-mobile-sm="2"
            data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
            data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
            <div class="swiper-wrapper">
                @if ($homeCms->section5_heading1)
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <img src="{{ !empty($homeCms->section5_icon1) ? url('/') . Storage::url($homeCms->section5_icon1) : '' }}"
                                height="100px" width="100px">
                            <div class="content text-center">
                                @if ($homeCms->section5_heading1)
                                    <h6>{{ $homeCms->section5_heading1 }}</h6>
                                @endif
                                @if ($homeCms->section5_sub_heading1)
                                    <p class="text-secondary">{{ $homeCms->section5_sub_heading1 }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($homeCms->section5_heading2)
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <img src="{{ !empty($homeCms->section5_icon2) ? url('/') . Storage::url($homeCms->section5_icon2) : '' }}"
                                height="100px" width="100px">

                            <div class="content text-center">
                                @if ($homeCms->section5_heading2)
                                    <h6>{{ $homeCms->section5_heading2 }}</h6>
                                @endif
                                @if ($homeCms->section5_sub_heading2)
                                    <p class="text-secondary">{{ $homeCms->section5_sub_heading2 }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($homeCms->section5_heading3)
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <img src="{{ !empty($homeCms->section5_icon3) ? url('/') . Storage::url($homeCms->section5_icon3) : '' }}"
                                height="100px" width="100px">

                            <div class="content text-center">
                                @if ($homeCms->section5_heading3)
                                    <h6>{{ $homeCms->section5_heading3 }}</h6>
                                @endif
                                @if ($homeCms->section5_sub_heading3)
                                    <p class="text-secondary">{{ $homeCms->section5_sub_heading3 }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($homeCms->section5_heading4)
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <img src="{{ !empty($homeCms->section5_icon4) ? url('/') . Storage::url($homeCms->section5_icon4) : '' }}"
                                height="100px" width="100px">

                            <div class="content text-center">
                                @if ($homeCms->section5_heading4)
                                    <h6>{{ $homeCms->section5_heading4 }}</h6>
                                @endif
                                @if ($homeCms->section5_sub_heading4)
                                    <p class="text-secondary">{{ $homeCms->section5_sub_heading4 }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="sw-pagination-iconbox sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
<!-- /Iconbox -->

<!-- Gallery shop gram -->

<section class="flat-spacing">
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h3 class="heading">Our Showcase</h3>
            <p class="subheading text-secondary">A sleek platform for buying and selling lighting and electrical
                equipment with ease. </p>
        </div>
        <div dir="ltr" class="swiper tf-sw-shop-gallery" data-preview="5" data-tablet="3" data-mobile="2"
            data-space-lg="10" data-space-md="10" data-space="8" data-pagination="2" data-pagination-md="3"
            data-pagination-lg="5">
            <div class="swiper-wrapper">
                @if (!empty($showcase))
                    @foreach ($showcase as $k => $value)
                        <div class="swiper-slide">
                            <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay=".1s">
                                <div class="img-style">
                                    <img class="lazyload img-hover"
                                        data-src="{{ !empty($value->showcase_image) && Storage::exists($value->showcase_image) ? url('/') . Storage::url($value->showcase_image) : '' }}"
                                        src="{{ !empty($value->showcase_image) && Storage::exists($value->showcase_image) ? url('/') . Storage::url($value->showcase_image) : '' }}"
                                        alt="image-gallery">
                                </div>
                                <a href="javascript:;" class="box-icon hover-tooltip view-image"
                                    data-image="{{ !empty($value->showcase_image) && Storage::exists($value->showcase_image) ? url('/') . Storage::url($value->showcase_image) : '' }}">
                                    <span class="icon icon-eye"></span>
                                    <!-- <span class="tooltip"></span> -->
                                </a>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="sw-pagination-gallery sw-dots type-circle justify-content-center"></div>


        </div>
        <!-- Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body text-center p-0">
                        <img id="modalImage" src="" alt="Product Image" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>


        <div dir="ltr" class="swiper tf-sw-testimonial-icon wow fadeInUp pt-5" data-wow-delay="0.1s"
            data-preview="5" data-tablet="5" data-mobile="5" data-space-lg="0" data-space-md="0" data-space="15"
            data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
            <div class="swiper-wrapper">
                @if (!empty($brands))
                    @foreach ($brands as $k => $value)
                        <div class="swiper-slide">
                            <img data-src="{{ !empty($value->brand_image) && Storage::exists($value->brand_image) ? url('/') . Storage::url($value->brand_image) : '' }}"
                                src="{{ !empty($value->brand_image) && Storage::exists($value->brand_image) ? url('/') . Storage::url($value->brand_image) : '' }}"
                                alt="{{ !empty($value->brand_name) ? '' . $value->brand_name : '-' }}">
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center"></div>
        </div>
    </div>
</section>

<!-- /Gallery shop gram -->

@include ('Front.includes.footer')

<script>
    $(".home").addClass("active");
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        const modalImage = document.getElementById('modalImage');

        document.querySelectorAll('.view-image').forEach(button => {
            button.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                modalImage.src = imageUrl;
                modal.show();
            });
        });
    });
</script>
