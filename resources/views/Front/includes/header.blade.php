<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">


<head>
    <meta charset="utf-8">
    <title>@yield('title','LCW Lighting')</title>

    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="title" content="@yield('title')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="description" content="@yield('meta_description')">
        @yield('meta-header')

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- font -->
    <link rel="stylesheet" href="{{ URL::asset('front/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/fonts/font-icons.css') }}">
    <!-- css -->
    <link rel="stylesheet" href="{{ URL::asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/css/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('front/css/drift-basic.min.css') }}">
    <link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('front/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('front/css/custom.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Favicon and Touch Icons  -->

    @php
       
        use App\Models\Master\Visual_setting;
        use App\Models\Master\General_setting;
                                
        $setting = General_setting::where('status', 'active')->orderBy('id', 'desc')->first();
        $visual_setting = Visual_setting::where('status', 'active')->orderBy('id', 'desc')->first();
                                
    @endphp
    @php
        $slider_img = !empty($visual_setting->favicon_image_path)?url('/') . Storage::url($visual_setting->favicon_image_path):URL::asset('front/images/logo/LCW_Logo.png');
    @endphp
    <link rel="shortcut icon" href="{{ $slider_img }}">
    <link rel="apple-touch-icon-precomposed" href="{{ $slider_img }}">

    <style>
        .error{
            color:red;
        }
    </style>
</head>

<body class="preload-wrapper">
<input type="hidden" value="{{url('/')}}" id="base_url"/>
    <!-- RTL -->
    <!-- <a href="javascript:void(0);" id="toggle-rtl" class="btn-style-2 radius-3"><span>RTL</span></a> -->
    <!-- /RTL  -->

    <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
                <path
                    d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <clipPath id="clip0_15741_24194">
                    <rect width="24" height="24" fill="white" transform="translate(0 0.66748)" />
                </clipPath>
            </defs>
        </svg>
    </button>

    <!-- preload -->
    <!-- <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div> -->
    <!-- /preload -->

    <div id="wrapper">
        <!-- Header -->
        <header id="header" class="header-default">
            <div class="container">
                <div class="row wrapper-header align-items-center">
                    <div class="col-md-4 col-3 d-xl-none">
                        <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                            <i class="icon icon-categories"></i>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{ url('/') }}" class="logo-header mt-2">
                            @php
                                $slider_img = !empty($visual_setting->main_logo_image_path)?url('/') . Storage::url($visual_setting->main_logo_image_path):URL::asset('front/images/logo/LCW_Logo.png');
                            @endphp
                            <img src="{{ $slider_img }}" alt="logo"
                                class="logo">
                        </a>
                    </div>
                    <div class="col-xl-6 d-none d-xl-block">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-center">
                                <li class="menu-item home">
                                    <a href="{{ url('/') }}" class="item-link">Home</a>

                                </li>
                                <li class="menu-item about">
                                    <a href="{{ url('about') }}" class="item-link">About Us</a>

                                </li>
                                <li class="menu-item product">

                                @php
                                use App\Models\Master\CategoryMaster;
                                $categories_tree = CategoryMaster::with(['subCategories' => function ($query) {
                                    $query->select('id', 'category_id', 'sub_category_name', 'slug')
                                        ->where('status', 'active');
                                }])
                                ->select('id', 'category_name', 'slug')
                                ->where('status', 'active')
                                ->get();

                                @endphp

                            <a href="{{ url('products') }}" class="item-link">Product<i class="icon icon-arrow-down"></i></a>
                            <div class="sub-menu mega-menu">
                                <div class="container">
                                    <div class="row">
                                        @if($categories_tree->isNotEmpty())
                                            @foreach($categories_tree as $val)

                                                @php   
                                                    $is_products_there = App\Models\Products::where('status','active')
                                                                            ->where('category_id', $val->id)
                                                                            ->where('is_available', 'available')
                                                                            ->get();
                                                @endphp
                                                <div class="col-lg-4">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">
                                                            <a href="{{url('/')}}/product-categories/{{!empty($val->slug)?$val->slug:''}}">
                                                            {{ $val->category_name }}
                                                            </a>
                                                        </div>
                                                        <ul class="menu-list">
                                                            @if($val->subCategories->isNotEmpty())
                                                                @foreach($val->subCategories as $subval)

                                                                    @php   
                                                                        $is_products_there = App\Models\Products::where('status','active')
                                                                                                ->where('sub_category_id', $val->id)
                                                                                                ->where('is_available', 'available')
                                                                                                ->get();
                                                                    @endphp
                                                                    
                                                                    <li>
                                                                        <a href="{{ url('product-sub-categories/' . $subval->slug) }}" class="menu-link-text">
                                                                            {{ $subval->sub_category_name }}
                                                                        </a>
                                                                    </li>
                                                                    
                                                                @endforeach
                                                            @else
                                                                
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                                </li>

                                <li class="menu-item blogs">
                                    <a href="{{ url('blogs') }}" class="item-link">Blogs</a>

                                </li>
                                <li class="menu-item position-relative contact">
                                    <a href="{{ url('contact') }}" class="item-link">Contact</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-3 col-md-4 col-3">
                        <ul class="nav-icon d-flex justify-content-end align-items-center">
                            <li class="nav-search"><a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a></li>
                            <li class="nav-account">
                                <a href="{{ url('my-account') }}" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="dropdown-account dropdown-login">
                                    <div class="sub-top">
                                        @if (!Auth::guard('master_users')->check()) 
                                        <a href="{{ url('login') }}" class="tf-btn btn-reset">Login</a>
                                        <p class="text-center text-secondary-2">Don’t have an account? <a
                                            href="{{ url('register') }}">Register</a></p>
                                        @else
                                        <p class="text-secondary-2">Welocome {{Auth::guard('master_users')->user()->full_name}}..!</p>
                                        @endif
                                    </div>
                                    @if (Auth::guard('master_users')->check()) 
                                    <div class="sub-top mt-2">
                                        <a href="{{ url('my-account') }}">My Account</a>
                                    </div>
                                    <div class="sub-top  mt-2">
                                        <a href="{{ url('my-account-orders') }}">My Order</a>
                                    </div>
                                    <div class="sub-top  mt-2">
                                        <a href="{{ url('wishlist') }}">Wishlist</a>
                                    </div>
                                    <div class="sub-top mt-2">
                                        <a href="{{ url('my-account-address') }}">My Address</a>
                                    </div>
                                    <div class="sub-bot">
                                        <a href="{{ url('logout') }}">Logout</a>
                                    </div>
                                    @endif
                                </div>

                            </li>
                            {{-- <li class="nav-wishlist"><a href="{{ url('wish-list') }}" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li> --}}
                            <li class="nav-cart"><a href="{{ url('shopping-cart') }}" data-bs-toggle=""
                                    class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span class="count-box" id="cart-count">
                                    @php
                                        \App\Helpers\Helpers\Helper::getCartCount();
                                    @endphp
                                    {{ !empty(session('cart_count'))?session('cart_count'):0; }}
                                    </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->

        <!-- mobile menu -->
        <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            <div class="mb-canvas-content">
                <div class="mb-body">
                    <div class="mb-content-top">
                        <form class="form-search">
                            <fieldset class="text">
                                <input type="text" placeholder="What are you looking for?" class=""
                                    name="text" tabindex="0" value="" aria-required="true"
                                    required="">
                            </fieldset>
                            <button class="" type="submit">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#181818" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20.9984 20.9999L16.6484 16.6499" stroke="#181818" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </form>
                        <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                            <li class="nav-mb-item active">
                                <a href="{{ url('/') }}" class="mb-menu-link" >
                                    <span>Home</span>
                                </a>

                            </li>
                            <li class="nav-mb-item">
                                <a href="{{ url('/about') }}" class="mb-menu-link" >
                                    <span>About US</span>
                                </a>
                            </li>
                            <li class="nav-mb-item">
                                <a href="#dropdown-menu-three" class="collapsed mb-menu-link"
                                    data-bs-toggle="collapse" aria-expanded="true"
                                    aria-controls="dropdown-menu-three">
                                    <span>Products</span>
                                    <span class="btn-open-sub"></span>
                                </a>
                                <div id="dropdown-menu-three" class="collapse">
                                    <ul class="sub-nav-menu">
                                        <li>
                                            <a href="#sub-product-one" class="sub-nav-link collapsed" data-bs-toggle="collapse"
                                                aria-expanded="true" aria-controls="sub-product-one">
                                                <span>Indoor</span>
                                                <span class="btn-open-sub"></span>
                                            </a>
                                            <div id="sub-product-one" class="collapse">
                                                <ul class="sub-nav-menu sub-menu-level-2">
                                                    <li><a href="{{ url('product-categories') }}" class="sub-nav-link">Recessed Ceiling</a></li>
                                                    <li><a href="{{ url('product-categories') }}" class="sub-nav-link">Surface Ceiling</a>
                                                    </li>
                                                    <li><a href="{{ url('product-categories') }}" class="sub-nav-link">Wall Surface</a>
                                                    </li>
                                                    <li><a href="{{ url('product-categories') }}" class="sub-nav-link">Track Light</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Wall</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">48V Track System</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Wall Recessed</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Table/Floor</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Pendent</a></li>

                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#sub-product-two" class="sub-nav-link collapsed" data-bs-toggle="collapse"
                                                aria-expanded="true" aria-controls="sub-product-two">
                                                <span>Outdoor</span>
                                                <span class="btn-open-sub"></span>
                                            </a>
                                            <div id="sub-product-two" class="collapse">
                                                <ul class="sub-nav-menu sub-menu-level-2">
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Recessed Ground</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Wall Recessed</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Surface Ground</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Wall Surface</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Floor Surface</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#sub-product-three" class="sub-nav-link collapsed" data-bs-toggle="collapse"
                                                aria-expanded="true" aria-controls="sub-product-three">
                                                <span>LED Strip Light</span>
                                                <span class="btn-open-sub"></span>
                                            </a>
                                            <div id="sub-product-three" class="collapse">
                                                <ul class="sub-nav-menu sub-menu-level-2">
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Series 1 | 4.8W</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Series 2 | 9.6W</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Series 3 | 18W</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Series 4 | 14.4W</a>
                                                    </li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Series 5 | 24W</a></li>
                                                    <li><a href="{{ url('product-categories') }}"
                                                            class="sub-nav-link">Series 6 | 30W</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- <li class="nav-mb-item">
                                <a href="#dropdown-menu-four" class="collapsed mb-menu-link"
                                    data-bs-toggle="collapse" aria-expanded="true"
                                    aria-controls="dropdown-menu-four">
                                    <span>Downloads</span>
                                </a>

                            </li> -->
                            <li class="nav-mb-item">
                                <a href="{{ url('/contact') }}" class="mb-menu-link">
                                    <span>Contact</span>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="mb-other-content">
                        <div class="group-icon">

                            <a href="{{ url('my-account') }}" class="site-nav-icon">
                                <svg class="icon" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                My Account
                            </a>
                            <a href="{{ url('login') }}" class="site-nav-icon">
                                <svg version="1.1" width="18" height="18" id="fi_942799" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M414.007,148.75c5.522,0,10-4.477,10-10V30c0-16.542-13.458-30-30-30h-364c-16.542,0-30,13.458-30,30v452
                                                c0,16.542,13.458,30,30,30h364c16.542,0,30-13.458,30-30v-73.672c0-5.523-4.478-10-10-10c-5.522,0-10,4.477-10,10V482
                                                c0,5.514-4.486,10-10,10h-364c-5.514,0-10-4.486-10-10V30c0-5.514,4.486-10,10-10h364c5.514,0,10,4.486,10,10v108.75
                                                C404.007,144.273,408.485,148.75,414.007,148.75z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M212.007,54c-50.729,0-92,41.271-92,92c0,26.317,11.11,50.085,28.882,66.869c0.333,0.356,0.687,0.693,1.074,1
                                                c16.371,14.979,38.158,24.13,62.043,24.13c23.885,0,45.672-9.152,62.043-24.13c0.387-0.307,0.741-0.645,1.074-1
                                                c17.774-16.784,28.884-40.552,28.884-66.869C304.007,95.271,262.736,54,212.007,54z M212.007,218
                                                c-16.329,0-31.399-5.472-43.491-14.668c8.789-15.585,25.19-25.332,43.491-25.332c18.301,0,34.702,9.747,43.491,25.332
                                                C243.405,212.528,228.336,218,212.007,218z M196.007,142v-6.5c0-8.822,7.178-16,16-16s16,7.178,16,16v6.5c0,8.822-7.178,16-16,16
                                                S196.007,150.822,196.007,142z M269.947,188.683c-7.375-10.938-17.596-19.445-29.463-24.697c4.71-6.087,7.523-13.712,7.523-21.986
                                                v-6.5c0-19.851-16.149-36-36-36s-36,16.149-36,36v6.5c0,8.274,2.813,15.899,7.523,21.986
                                                c-11.867,5.252-22.088,13.759-29.463,24.697c-8.829-11.953-14.06-26.716-14.06-42.683c0-39.701,32.299-72,72-72s72,32.299,72,72
                                                C284.007,161.967,278.776,176.73,269.947,188.683z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M266.007,438h-54c-5.522,0-10,4.477-10,10s4.478,10,10,10h54c5.522,0,10-4.477,10-10S271.529,438,266.007,438z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M266.007,382h-142c-5.522,0-10,4.477-10,10s4.478,10,10,10h142c5.522,0,10-4.477,10-10S271.529,382,266.007,382z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M266.007,326h-142c-5.522,0-10,4.477-10,10s4.478,10,10,10h142c5.522,0,10-4.477,10-10S271.529,326,266.007,326z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M88.366,272.93c-1.859-1.86-4.439-2.93-7.079-2.93c-2.631,0-5.211,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07
                                                s1.069,5.21,2.93,7.07c1.87,1.86,4.439,2.93,7.07,2.93c2.64,0,5.21-1.07,7.079-2.93c1.86-1.86,2.931-4.44,2.931-7.07
                                                S90.227,274.79,88.366,272.93z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M88.366,328.93c-1.869-1.86-4.439-2.93-7.079-2.93c-2.631,0-5.2,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07
                                                s1.069,5.21,2.93,7.07c1.87,1.86,4.439,2.93,7.07,2.93c2.64,0,5.21-1.07,7.079-2.93c1.86-1.86,2.931-4.44,2.931-7.07
                                                S90.227,330.79,88.366,328.93z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M88.366,384.93c-1.869-1.86-4.439-2.93-7.079-2.93c-2.631,0-5.2,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07
                                                s1.069,5.21,2.93,7.07c1.859,1.86,4.439,2.93,7.07,2.93c2.64,0,5.22-1.07,7.079-2.93c1.86-1.86,2.931-4.44,2.931-7.07
                                                S90.227,386.79,88.366,384.93z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M266.007,270h-142c-5.522,0-10,4.477-10,10s4.478,10,10,10h142c5.522,0,10-4.477,10-10S271.529,270,266.007,270z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M491.002,130.32c-9.715-5.609-21.033-7.099-31.871-4.196c-10.836,2.904-19.894,9.854-25.502,19.569L307.787,363.656
                                                c-0.689,1.195-1.125,2.52-1.278,3.891l-8.858,79.344c-0.44,3.948,1.498,7.783,4.938,9.77c1.553,0.896,3.278,1.34,4.999,1.34
                                                c2.092,0,4.176-0.655,5.931-1.948l64.284-47.344c1.111-0.818,2.041-1.857,2.73-3.052l125.841-217.963
                                                C517.954,167.638,511.058,141.9,491.002,130.32z M320.063,426.394l4.626-41.432l28.942,16.71L320.063,426.394z M368.213,386.996
                                                l-38.105-22l100.985-174.91l38.105,22L368.213,386.996z M489.054,177.693l-9.857,17.073l-38.105-22l9.857-17.073
                                                c2.938-5.089,7.682-8.729,13.358-10.25c5.678-1.522,11.606-0.74,16.694,2.198c5.089,2.938,8.729,7.682,10.25,13.358
                                                C492.772,166.675,491.992,172.604,489.054,177.693z"></path>
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    </svg>
                                Login / Register
                            </a>

                        </div>
                        <div class="mb-notice">
                            <a href="{{ url('contact') }}" class="text-need">Need Help?</a>
                        </div>
                        <div class="mb-contact">
                            <p class="text-caption-1">Ware Houses At 1- Mount Annan 2- Revesby 3- Seven Hills 4- Silverwater</p>
                            <a href="#" class="tf-btn-default text-btn-uppercase">GET DIRECTION<i
                                    class="icon-arrowUpRight"></i></a>
                        </div>
                        <ul class="mb-info">
                            <li>
                                <i class="icon icon-mail"></i>
                                <p>info@lcwlighting.com</p>
                            </li>
                            <li>
                                <i class="icon icon-phone"></i>
                                <p>+61 469 302 231</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /mobile menu -->

        <!-- search -->
    <div class="modal fade modal-search" id="search">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Search</h5>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <form class="form-search" action="{{url('products/search-results')}}" method="get">
                    
                    <fieldset class="text">
                        <input type="text" placeholder="Searching..." class="" name="q" tabindex="0" value="" aria-required="true" required>
                    </fieldset>
                    <button class="" type="submit">
                        <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </form>
                <div style="display: none;">
                    <h5 class="mb_16">Feature keywords Today </h5>
                    <ul class="list-tags">
                        <li><a href="{{url('products/search-results')}}?q={{'led'}}" class="radius-60 link">LED</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /search -->
