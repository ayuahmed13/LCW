@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ('Front.includes.header')
<style>
    /* .widget-facet.facet-categories li:not(:last-child){
        margin-bottom: 5px !important;
    } */
    .list-unstyled {
        padding: 5px 0 !important;
    }

    .empty-cart {
        height: 100vh !important;
        margin: 24px 0 0 15px !important;
    }
</style>
<!-- page-title -->
<div class="page-title" style="background-image: url(images/section/page-title.jpg); background-color:#f4f3ee">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Products</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        Products
                    </li>
                    @if (!empty($is_search))
                        <li>
                            <i class="icon-arrRight"></i>
                        </li>
                        <li>
                            Search
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->
<!-- Section product -->
<section class="flat-spacing">
    <div class="container">
        <div class="wrapper-control-shop">
            <div class="meta-filter-shop">
                <div id="product-count-grid" class="count-text"></div>
                <div id="product-count-list" class="count-text"></div>
                <div id="applied-filters"></div>
                <button id="remove-all" class="remove-all-filters text-btn-uppercase" style="display: none;">REMOVE ALL
                    <i class="icon icon-close"></i></button>
            </div>
            <div class="row">
                <div class="col-xl-3">
                    <div class="sidebar-filter canvas-filter left">
                        <div class="canvas-wrapper">
                            <div class="canvas-header d-flex d-xl-none">
                                <h5 style="color: black">Filters</h5>
                                <span class="icon-close close-filter"></span>
                            </div>
                            <div class="canvas-body">
                                <div class="tf-shop-control">
                                    <div class="tf-control-sorting">
                                        <p class="d-none d-lg-block text-caption-1">Sort by:</p>
                                        <div class="tf-dropdown-sort1" data-bs-toggle="dropdown">
                                            <div class="mb-0">
                                                <select class="form-select" id="sort" name="sort">
                                                    <option value="">Select</option>
                                                    <option
                                                        {{ !empty($_GET['sort']) && $_GET['sort'] == 'az' ? 'selected' : '' }}
                                                        value="az">Alphabetically, A-Z</option>
                                                    <option
                                                        {{ !empty($_GET['sort']) && $_GET['sort'] == 'za' ? 'selected' : '' }}
                                                        value="za">Alphabetically, Z-A</option>
                                                    <option
                                                        {{ !empty($_GET['sort']) && $_GET['sort'] == 'prlh' ? 'selected' : '' }}
                                                        value="prlh">Price, low to high</option>
                                                    <option
                                                        {{ !empty($_GET['sort']) && $_GET['sort'] == 'prhl' ? 'selected' : '' }}
                                                        value="prhl">Price, high to low</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @if (empty($is_search))

                                    <div class="widget-facet facet-categories pe-3">
                                        <h6 class="facet-title">Product Categories</h6>


                                        @if (!empty($categories_tree_sidebar))
                                            <ul class="facet-content">
                                                @foreach ($categories_tree_sidebar as $ck => $category)
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            @php
                                                                $segment1 = request()->segment(1);
                                                                $segment2 = request()->segment(2);
                                                                $shouldShow = '';
                                                                if (!empty($category->subCategories)) {
                                                                    foreach (
                                                                        $category->subCategories
                                                                        as $sub_category
                                                                    ) {
                                                                        if (
                                                                            !empty($sub_parent_category_slug) &&
                                                                            $sub_parent_category_slug ==
                                                                                $sub_category->slug
                                                                        ) {
                                                                            $shouldShow = 'show';
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <!-- #0d6efd -->
                                                            <a class="categories-item d-flex justify-content-between align-items-center"
                                                                href="{{ url('product-categories') }}/{{ $category->slug }}"
                                                                role="button">
                                                                <span
                                                                    @if (!empty($category->slug) && $category->slug == $segment2) style="color:#3af1ff" @endif>{{ $category->category_name }}
                                                                    <span class="count-cate"></span></span>
                                                            </a>

                                                            <a class="categories-item d-flex justify-content-between align-items-center collapsed"
                                                                data-bs-toggle="collapse"
                                                                href="#$ck_{{ $ck }}" role="button"
                                                                aria-expanded="false" aria-controls="$ck_0"
                                                                style="float: right; margin-top:-25px; margin-right:-15px;">
                                                                <i class="bi bi-chevron-down arr_down"
                                                                    id="carr_{{ $ck }}"></i>
                                                            </a>

                                                            <ul class="collapse ps-3 {{ $shouldShow }}"
                                                                id="$ck_{{ $ck }}">
                                                                @if (!empty($category->subCategories))
                                                                    @foreach ($category->subCategories as $sck => $sub_category)
                                                                        <li>
                                                                            <a
                                                                                href="{{ url('product-sub-categories') }}/{{ $sub_category->slug }}">
                                                                                <span
                                                                                    @if (!empty($sub_category->slug) && $sub_category->slug == $segment2) style="color:#3af1ff" @endif>{{ $sub_category->sub_category_name }}
                                                                                    <span class="count-cate">
                                                                                        ({{ !empty($sub_category->products_count) ? $sub_category->products_count : '0' }})
                                                                                    </span></span>
                                                                            </a>

                                                                            <a class="d-flex justify-content-between align-items-center pt-1 text-muted"
                                                                                data-bs-toggle="collapse"
                                                                                href="#sck_{{ $sck }}{{ $ck }}"
                                                                                role="button" aria-expanded="false"
                                                                                aria-controls="sck_{{ $sck }}{{ $ck }}"
                                                                                style="float: right; margin-top:0px; margin-right:-15px;">
                                                                                <i class="bi bi-chevron-down arr_down"
                                                                                    id="scarr_{{ $sck }}{{ $ck }}"></i>
                                                                            </a>

                                                                            @php
                                                                                $shouldShowSsc = '';
                                                                                if (
                                                                                    !empty(
                                                                                        $sub_category->subSubCategories
                                                                                    )
                                                                                ) {
                                                                                    foreach (
                                                                                        $sub_category->subSubCategories
                                                                                        as $sub_sub_category
                                                                                    ) {
                                                                                        if (
                                                                                            !empty($category_slugc) &&
                                                                                            $category_slugc ==
                                                                                                $sub_sub_category->slug
                                                                                        ) {
                                                                                            $shouldShowSsc = 'show';
                                                                                            break;
                                                                                        }
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            <ul class="collapse ps-3 {{ $shouldShowSsc }}"
                                                                                id="sck_{{ $sck }}{{ $ck }}">
                                                                                @if (!empty($sub_category->subSubCategories))
                                                                                    @foreach ($sub_category->subSubCategories as $sub_sub_category)
                                                                                        <li><a class="d-block pt-1 text-muted"
                                                                                                @if (!empty($sub_sub_category->slug) && $sub_sub_category->slug == $segment2) style="color:#0d6efd!important" @endif
                                                                                                href="{{ url('product-sub-sub-categories') }}/{{ $sub_sub_category->slug }}">
                                                                                                {{ $sub_sub_category->sub_sub_category_name }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <ul class="facet-content" style="display: none;">
                                            <li><a href="#" class="categories-item">Downlights <span
                                                        class="count-cate">(112)</span></a></li>
                                            <li><a href="#" class="categories-item">New Products <span
                                                        class="count-cate">(32)</span> </a></li>
                                            <li><a href="#" class="categories-item">LED Strip Light <span
                                                        class="count-cate">(42)</span></a></li>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="categories-item active d-flex justify-content-between align-items-center"
                                                        data-bs-toggle="collapse" href="#trackLights" role="button"
                                                        aria-expanded="true" aria-controls="trackLights">
                                                        <span>LED Track Lights <span
                                                                class="count-cate">(6)</span></span>
                                                        <i class="bi bi-chevron-down"></i>
                                                    </a>

                                                    <ul class="collapse show ps-3" id="trackLights">
                                                        <li>
                                                            <a class="d-flex justify-content-between align-items-center pt-1 text-muted"
                                                                data-bs-toggle="collapse" href="#trackSpotlights"
                                                                role="button" aria-expanded="false"
                                                                aria-controls="trackSpotlights">
                                                                <span>Track Spotlights <span
                                                                        class="count-cate">(6)</span></span>
                                                                <i class="bi bi-chevron-down"></i>
                                                            </a>
                                                            <ul class="collapse ps-3" id="trackSpotlights">
                                                                <li><a class="d-block pt-1 text-muted"
                                                                        href="#">LED Track Spotlights RGB</a>
                                                                </li>
                                                                <li><a class="d-block pt-1 text-muted"
                                                                        href="#">LED Track Spotlights CCT</a>
                                                                </li>
                                                                <li><a class="d-block pt-1 text-muted"
                                                                        href="#">LED Track Spotlights RGB+CCT</a>
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        <li><a class="d-block pt-1 text-muted" href="#">Track
                                                                Linear Spotlights <span
                                                                    class="count-cate">(6)</span></a></li>
                                                        <li><a class="d-block pt-1 text-muted" href="#">Track
                                                                Linear Adjustable Spotlights <span
                                                                    class="count-cate">(6)</span></a></li>
                                                        <li><a class="d-block pt-1 text-muted" href="#">Track
                                                                Linear Floodlights <span
                                                                    class="count-cate">(6)</span></a></li>
                                                        <li><a class="d-block pt-1 text-muted" href="#">Track
                                                                Light Rails <span class="count-cate">(6)</span></a>
                                                        </li>
                                                        <li><a class="d-block pt-1 text-muted" href="#">Track
                                                                Accessories <span class="count-cate">(6)</span></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>



                                            <li><a href="#" class="categories-item">Neon Flex <span
                                                        class="count-cate">(13)</span></a></li>
                                            <li><a href="#" class="categories-item">LED Controllers <span
                                                        class="count-cate">(52)</span></a></li>
                                            <li><a href="#" class="categories-item">Power Suppliers <span
                                                        class="count-cate">(17)</span></a></li>
                                            <li><a href="#" class="categories-item">LED Profile | LED Aluminium
                                                    Extrusion<span class="count-cate">(4)</span></a></li>
                                            <li><a href="#" class="categories-item">Outdoor Lights <span
                                                        class="count-cate">(41)</span></a></li>
                                            <li><a href="#" class="categories-item">Sign LED Modules<span
                                                        class="count-cate">(75)</span></a></li>
                                            <li><a href="#" class="categories-item">LED Accessories<span
                                                        class="count-cate">(35)</span></a></li>
                                            <li><a href="#" class="categories-item">Unique Products<span
                                                        class="count-cate">(20)</span></a></li>
                                        </ul>
                                    </div>


                                    <form name="filterForm" id="filterForm" method="get">
                                        @csrf
                                        <div class="widget-facet facet-fieldset">
                                            <h6 class="facet-title">Availability</h6>
                                            <div class="box-fieldset-item">
                                                <fieldset class="fieldset-item">
                                                    <input
                                                        {{ !empty($availability && $availability == 'instock') ? 'checked' : '' }}
                                                        type="radio" name="availability" value="instock"
                                                        class="tf-check availability" id="inStock">
                                                    <label for="inStock">In stock<span
                                                            class="count-stock">{{ !empty($product_instock) ? '(' . $product_instock . ')' : '(0)' }}</span></label>
                                                </fieldset>
                                                <fieldset class="fieldset-item">
                                                    <input
                                                        {{ !empty($availability && $availability == 'outstock') ? 'checked' : '' }}
                                                        type="radio" name="availability" value="outstock"
                                                        class="tf-check availability" id="outStock">
                                                    <label for="outStock">Out of stock<span
                                                            class="count-stock">{{ !empty($product_outstock) ? '(' . $product_outstock . ')' : '(0)' }}</span></label>
                                                </fieldset>
                                            </div>
                                        </div>

                                        @if (!empty($parameters))
                                            @foreach ($parameters as $key => $value)
                                                <div class="widget-facet facet-fieldset">
                                                    <h6 class="facet-title">
                                                        {{ ucwords($value->product_parameter_name) }}</h6>
                                                    <div class="box-fieldset-item">
                                                        @if (!empty($value->values))
                                                            @foreach ($value->values as $key => $value1)
                                                                <fieldset class="fieldset-item">
                                                                    <input type="checkbox" name="parameter_filter[]"
                                                                        class="tf-check parameter-filter"
                                                                        id="inStock"
                                                                        value="{{ $value->id }}??#{{ $value1->id }}"
                                                                        data-parameter-value="{{ $value1->id }}"
                                                                        {{ !empty($product_parameter_value_id_arr) && in_array($value1->id, $product_parameter_value_id_arr) ? 'checked' : '' }}>
                                                                    <label
                                                                        for="inStock">{{ $value1->product_parameter_value }}<span
                                                                            class="count-stock"
                                                                            id="stock_{{ $value1->id }}">(0)</span></label>
                                                                </fieldset>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </form>
                                @endif
                            </div>
                            <div class="canvas-bottom d-block d-xl-none">
                                <button id="reset-filter" class="tf-btn btn-reset">Reset Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">

                    <div class="mb-5">
                        <div class="mb-3">
                            <h3 class="title mb-2 wow fadeInUp">
                                {{ !empty($sub_category_data->sub_category_name) ? $sub_category_data->sub_category_name : '' }}
                                {{ !empty($category_data->category_name) ? $category_data->category_name : '' }}
                            </h3>
                            <div class="widget-tabs style-3">
                                {{ !empty($sub_category_data->sub_category_description) ? $sub_category_data->sub_category_description : '' }}
                                {{ !empty($category_data->category_description) ? $category_data->category_description : '' }}
                            </div>
                        </div>
                        <div class="container-full slider-layout-right wow fadeInUp mt-4" data-wow-delay="0.1s">
                            <div class="row g-3"> <!-- Bootstrap grid with gap -->
                                @if (!empty($sub_sub_category_list))
                                    @foreach ($sub_sub_category_list as $k => $value)
                                        <!-- 1 -->
                                        <div class="col-6 col-md-4 col-lg-3 ps-0">
                                            <div class="collection-position-2 hover-img">
                                                <a href="{{ url('product-sub-sub-categories/' . $value->slug) }}"
                                                    class="img-style">

                                                    @if (!empty($value->sub_sub_category_image))
                                                        <img class="lazyload"
                                                            data-src="{{ !empty($value->sub_sub_category_image) && Storage::exists($value->sub_sub_category_image) ? url('/') . Storage::url($value->sub_sub_category_image) : URL::asset('front/images/default-img.jpg') }}"
                                                            src="{{ !empty($value->sub_sub_category_image) && Storage::exists($value->sub_sub_category_image) ? url('/') . Storage::url($value->sub_sub_category_image) : URL::asset('front/images/default-img.jpg') }}"
                                                            alt="banner-cls">
                                                    @else
                                                        <img class="lazyload"
                                                            data-src="{{ URL::asset('front/images/products/new-images/new-product-1.jpg') }}"
                                                            src="{{ URL::asset('front/images/products/new-images/new-product-1.jpg') }}"
                                                            alt="banner-cls">
                                                    @endif

                                                </a>
                                            </div>
                                            <a href="{{ url('product-sub-sub-categories/' . $value->slug) }}">
                                                <p class="pt-2">{{ $value->sub_sub_category_name }} <span
                                                        class="ps-1">
                                                        ({{ !empty($value->products_count) ? $value->products_count : 0 }})
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif

                                @if (!empty($sub_category_list))
                                    @foreach ($sub_category_list as $k => $value)
                                        <!-- 1 -->
                                        <div class="col-6 col-md-4 col-lg-3 ps-0">
                                            <div class="collection-position-2 hover-img">
                                                <a href="{{ url('product-sub-categories/' . $value->slug) }}"
                                                    class="img-style">

                                                    @if (!empty($value->sub_category_image))
                                                        <img class="lazyload"
                                                            data-src="{{ !empty($value->sub_category_image) && Storage::exists($value->sub_category_image) ? url('/') . Storage::url($value->sub_category_image) : '' }}"
                                                            src="{{ !empty($value->sub_category_image) && Storage::exists($value->sub_category_image) ? url('/') . Storage::url($value->sub_category_image) : '' }}"
                                                            alt="banner-cls">
                                                    @else
                                                        <img class="lazyload"
                                                            data-src="{{ URL::asset('front/images/products/new-images/new-product-1.jpg') }}"
                                                            src="{{ URL::asset('front/images/products/new-images/new-product-1.jpg') }}"
                                                            alt="banner-cls">
                                                    @endif

                                                </a>
                                            </div>
                                            <a href="{{ url('product-sub-categories/' . $value->slug) }}">
                                                <p class="pt-2">{{ $value->sub_category_name }} <span
                                                        class="ps-1">
                                                        ({{ !empty($value->products_count) ? $value->products_count : 0 }})
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- Continue for products 4, 5, 6 as needed -->

                            </div>
                        </div>



                    </div>
                    <div class="row g-4">
                        <h5 class="mb-0 wow fadeInUp">
                            Products

                            @php
                                $msg = '';
                                if (!empty($is_search)) {
                                    $msg = ' <small>Results found for search "' . $q . '"</small>';
                                    $icon = '<i class="icon icon-search2"></i>';
                                }
                            @endphp
                            {!! $msg !!}
                        </h5>
                        <!-- Product Card 2 -->
                        @if (!empty($product_list) && count($product_list))

                            @php
                                $tus = Auth::guard('master_users')->id();
                                if (empty($tus)) {
                                    $cart = session('cart', []);
                                }
                            @endphp

                            @foreach ($product_list as $k => $value)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="card-product grid" data-availability="Out of stock"
                                        data-brand="adidas">
                                        <div class="card-product-wrapper">
                                            <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url) ? $value->slug_url : '' }}"
                                                class="product-img">
                                                <img class="lazyload img-product w-100"
                                                    data-src="{{ !empty($value->product_main_image) && Storage::exists($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                                    src="{{ !empty($value->product_main_image) && Storage::exists($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                                    alt="image-product">
                                                <img class="lazyload img-hover w-100"
                                                    data-src="{{ !empty($value->product_main_image) && Storage::exists($value->product_main_image) ? url('/') . Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                                    src="{{ !empty($value->sub_category_image) && Storage::exists($value->sub_category_image) ? url('/') . Storage::url($value->sub_category_image) : URL::asset('front/images/default-img.jpg') }}"
                                                    alt="image-product">
                                            </a>
                                            <div class="on-sale-wrap"><span class="on-sale-item">
                                                    @php
                                                        $discount_percentage =
                                                            (($value->price - $value->offer_price) / $value->price) *
                                                            100;
                                                        echo $discount_percentage =
                                                            round($discount_percentage * -1, 2) . '%';
                                                    @endphp
                                                </span></div>
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
                                                <!-- if(!empty($cart_product_ids) && in_array($value->id,$cart_product_ids)) -->
                                                @if (
                                                    (!empty($cart_product_ids) && in_array($value->id, $cart_product_ids)) ||
                                                        (empty($tus) && !empty($cart) && ($inCart = array_key_exists($value->id, $cart))))
                                                    <a href="{{ url('/') }}/shopping-cart"
                                                        class="btn-main-product btn btn-primary w-100 go-to-cart"
                                                        data-product-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                        data-product-name="{{ !empty($value->product_name) ? $value->product_name : '' }}"
                                                        data-product-price="{{ !empty($value->offer_price) ? $value->offer_price : '' }}"
                                                        data-product-qty="{{ !empty($value->qty) ? $value->qty : 1 }}"
                                                        data-product-stock="{{ !empty($value->current_stock) ? $value->current_stock : 0 }}">Go
                                                        To cart</a>
                                                @else
                                                    <a href="#shoppingCart" data-bs-toggle="modal"
                                                        class="btn-main-product btn btn-primary w-100 add-to-cart"
                                                        data-product-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                        data-product-name="{{ !empty($value->product_name) ? $value->product_name : '' }}"
                                                        data-product-price="{{ !empty($value->offer_price) ? $value->offer_price : '' }}"
                                                        data-product-qty="{{ !empty($value->qty) ? $value->qty : 1 }}"
                                                        data-product-stock="{{ !empty($value->current_stock) ? $value->current_stock : 0 }}">Add
                                                        To cart</a>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="card-product-info ">
                                            <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url) ? $value->slug_url : '' }}"
                                                class="title link">{{ !empty($value->product_name) ? $value->product_name : '' }}</a>
                                            <div class="price"><span
                                                    class="old-price">${{ !empty($value->price) ? $value->price : '' }}</span>
                                                <span
                                                    class="current-price">${{ !empty($value->offer_price) ? $value->offer_price : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @php
                                $icon = '<i class="icon icon-ShoppingBagOpen"></i>';
                                $msg = 'Products not found';

                                if (!empty($is_search)) {
                                    $msg = 'Sorry! No results found for search "' . $q . '"';
                                    $icon = '<i class="icon icon-search2"></i>';
                                }
                            @endphp
                            <div class="empty-cart rounded">
                                <h1 class="text-center text-dark">
                                    {!! $icon !!}
                                </h1>
                                <h4 class="text-center text-dark">

                                    {{ $msg }}
                                </h4>

                            </div>

                        @endif


                        <div class="pagination-wrapper">
                            {{ $product_list->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
</section>
<!-- /Section product -->


@include ('Front.includes.footer')
<script>
    // Add show class on filter button click
    document.getElementById('filterShop').addEventListener('click', function() {
        document.querySelector('.sidebar-filter.canvas-filter.left').classList.add('show');
    });

    // Remove show class on close button click
    document.querySelector('.close-filter').addEventListener('click', function() {
        document.querySelector('.sidebar-filter.canvas-filter.left').classList.remove('show');
    });
</script>


<script src="{{ URL::asset('front/js/sibforms.js') }}" defer></script>

<script>
    $(".product").addClass("active");
</script>
<script>
    $('#sort').change(function(e) {
        var sort = $('#sort').val();
        if (sort !== '') {
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set('sort', sort);
            window.location.href = url.toString();
        }
    });

    $('.parameter-filter,.availability').click(function(e) {
        var selectedValues = [];

        // Get all checked parameter filters
        $('.parameter-filter:checked').each(function() {
            selectedValues.push($(this).val());
        });

        // Set the form's action to the current page URL
        $('#filterForm').attr('action', window.location.href);

        // Submit the form once after gathering all selected values
        $('#filterForm').submit();
    });
</script>
<script>
    $(document).ready(function() {
        var base_url = $('#base_url').val();
        var pid_arr = [];
        var vid_arr = [];
        var category_type = "{{ !empty($category_typec) ? $category_typec : '' }}";
        var category_slug = "{{ !empty($category_slugc) ? $category_slugc : '' }}";

        $('.parameter-filter').each(function() {
            let value = $(this).val();
            let pid = value.split('??#')[0];
            let vid = value.split('??#')[1];

            pid_arr.push(pid);
            vid_arr.push(vid);
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: base_url + "/products/get-parameter-wise-count",
            data: {
                pid: pid_arr,
                vid: vid_arr,
                category_type: category_type,
                category_slug: category_slug
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('.parameter-filter').each(function() {

                    let value = $(this).val();
                    let [pid, vid] = value.split('??#');

                    $.each(response, function(index, item) {
                        if (item.parameter_value_id === vid) {
                            $('#stock_' + item.parameter_value_id).html('(' + item
                                .products_count + ')');
                        }
                    });
                });
            }

            // error: function (xhr, status, error) {
            //     console.log("AJAX Error: ", status, error);
            // }
        });
    });
</script>
<script>
    $('.arr_down').click(function(e) {
        let id = $(this).attr('id');
        $(this).toggleClass('bi-chevron-down bi-chevron-up');
    });
</script>
