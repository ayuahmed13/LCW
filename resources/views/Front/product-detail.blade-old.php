@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")

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
                        <a  class="tf-breadcrumb-prev">
                            <i class="icon icon-arrLeft"></i>
                        </a>
                        <a  class="tf-breadcrumb-back">
                            <i class="icon icon-squares-four"></i>
                        </a>
                        <a  class="tf-breadcrumb-next">
                            <i class="icon icon-arrRight"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /breadcrumb -->

         <!-- page-title -->
         <div class="page-title" style="background-image: url('{{ asset('front/images/products/new-images/terms-top-banner-image.png') }}'); background-color:#f4f3ee">

            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Product detail</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="{{ url('') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                           
                            <li>
                                Product detail
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
                    <img class="lazyload img-product"
                                    data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}"
                                    src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                </div>
                <div class="content">
                    <div class="text-title">
                        <a class="link" href="{{ url('product-detail') }}">LED Track Spotlight CCT 6W 30°</a>
                    </div>
                    <div class="text-caption-1 text-secondary-2">LED</div>
                    <div class="text-title">$68.00</div>
                </div>
            </div>
            <a href="{{ url('shopping-cart') }}" class="tf-btn w-100 btn-fill radius-4"><span class="text text-btn-uppercase">View cart</span></a>
        </div>
        <!-- /tf-add-cart-success -->

        

        <!-- Product_Main -->
        <section class="flat-spacing">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <!-- Product default -->
                        <div class="col-md-6">
                            <div class="tf-product-media-wrap sticky-top">
                                <div class="thumbs-slider">
                                    <div class="gallery-container">
                                        <!-- Thumbnails -->
                                        <div class="thumbnail-list">
                                          <img src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" class="active" alt="Thumbnail 1" onclick="changeImage(this, 'front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')">
                                          <img src="{{URL::asset('front/images/products/new-images/best-sell-1.jpg')}}" alt="Thumbnail 2" onclick="changeImage(this, 'front/images/products/new-images/best-sell-1.jpg')">
                                          <img src="{{URL::asset('https://www.est.net.in/wp-content/uploads/2020/05/LED-Track-Light-FS4039-30-Image.jpg')}}" alt="Thumbnail 3" onclick="changeImage(this, 'https://www.est.net.in/wp-content/uploads/2020/05/LED-Track-Light-FS4039-30-Image.jpg')">
                                          <img src="{{URL::asset('https://5.imimg.com/data5/SELLER/Default/2024/9/454425618/DM/XE/AG/9484000/30-watt-led-track-light.jpg')}}" alt="Thumbnail 4" onclick="changeImage(this, 'https://5.imimg.com/data5/SELLER/Default/2024/9/454425618/DM/XE/AG/9484000/30-watt-led-track-light.jpg')">
                                          <img src="{{URL::asset('https://grnled.com/wp-content/uploads/2024/02/three-phase-Track-lighting.jpg.webp')}}" alt="Thumbnail 5" onclick="changeImage(this, 'https://grnled.com/wp-content/uploads/2024/02/three-phase-Track-lighting.jpg.webp')">
                                          <img src="{{URL::asset('https://dothelight.com/wp-content/uploads/2023/09/12w-zoomable-led-track-lighting-for-museum-247x300.png')}}" alt="Thumbnail 6" onclick="changeImage(this, 'https://dothelight.com/wp-content/uploads/2023/09/12w-zoomable-led-track-lighting-for-museum-247x300.png')">
                                        </div>
                                    
                                        <!-- Main Image -->
                                        <div class="main-image">
                                          <img id="mainDisplay" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="Main Display">
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
                                                    <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                    
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="beige">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="beige">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="beige">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="grey">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide stagger-item" data-color="grey">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide" data-color="gray">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="gray">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="gray">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="gray">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="beige">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="beige">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="beige">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="grey">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide" data-color="grey">
                                                <a href="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" target="_blank" class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div> --}}

                            {{-- <div class="gallery-container">
                                <!-- Thumbnails -->
                                <div class="thumbnail-list">
                                  <img src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" class="active" alt="Thumbnail 1" onclick="changeImage(this, 'front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')">
                                  <img src="{{URL::asset('front/images/products/new-images/best-sell-1.jpg')}}" alt="Thumbnail 2" onclick="changeImage(this, 'front/images/products/new-images/best-sell-1.jpg')">
                                  <img src="{{URL::asset('https://www.est.net.in/wp-content/uploads/2020/05/LED-Track-Light-FS4039-30-Image.jpg')}}" alt="Thumbnail 3" onclick="changeImage(this, 'https://www.est.net.in/wp-content/uploads/2020/05/LED-Track-Light-FS4039-30-Image.jpg')">
                                  <img src="{{URL::asset('https://5.imimg.com/data5/SELLER/Default/2024/9/454425618/DM/XE/AG/9484000/30-watt-led-track-light.jpg')}}" alt="Thumbnail 4" onclick="changeImage(this, 'https://5.imimg.com/data5/SELLER/Default/2024/9/454425618/DM/XE/AG/9484000/30-watt-led-track-light.jpg')">
                                  <img src="{{URL::asset('https://grnled.com/wp-content/uploads/2024/02/three-phase-Track-lighting.jpg.webp')}}" alt="Thumbnail 5" onclick="changeImage(this, 'https://grnled.com/wp-content/uploads/2024/02/three-phase-Track-lighting.jpg.webp')">
                                  <img src="{{URL::asset('https://dothelight.com/wp-content/uploads/2023/09/12w-zoomable-led-track-lighting-for-museum-247x300.png')}}" alt="Thumbnail 6" onclick="changeImage(this, 'https://dothelight.com/wp-content/uploads/2023/09/12w-zoomable-led-track-lighting-for-museum-247x300.png')">
                                </div>
                            
                                <!-- Main Image -->
                                <div class="main-image">
                                  <img id="mainDisplay" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="Main Display">
                                </div>
                              </div> --}}
                        </div>
                        <!-- /Product default -->
                        <!-- tf-product-info-list -->
                        <div class="col-md-6">
                            <div class="tf-product-info-wrap position-relative">
                                <div class="tf-zoom-main"></div>
                                <div class="tf-product-info-list other-image-zoom">
                                    <div class="tf-product-info-heading">
                                        <div class="tf-product-info-name">
                                            <div class="text text-btn-uppercase">Lighting</div>
                                            <h3 class="name">LED Track Spotlight CCT 6W 30°</h3>
                                        </div>
                                        <div class="tf-product-info-desc">
                                            <div class="tf-product-info-price">
                                                <h5 class="price-on-sale font-2">$79.99</h5>
                                                <div class="compare-at-price font-2">$98.99</div>
                                                <div class="badges-on-sale text-btn-uppercase">
                                                    -25%
                                                </div>
                                            </div>
                                            <p>The lighting products labelled as Committed are crafted using energy-efficient materials or sustainable manufacturing processes, helping to reduce their environmental impact.</p>
                                        </div>

                                        
                                    </div>
                                    <div class="pb-3">
    
                                        <!-- Row 1: Remote / Wall Plate Control -->
                                        <div class="row  mb-2">
                                          <div class="col-md-6">
                                            <div class="control-box">
                                              <div class="fw-medium">Remote / Wall Plate Control</div>
                                              <img src="{{URL::asset('front/images/products/new-images/remote.png')}}" alt="Remote Icon" class="remote-icon">
                                            </div>
                                          </div>
                                        </div>
                                    
                                        <!-- Row 2: App Control and Third Party Control -->
                                        <div class="row g-4">
                                          <!-- App Control -->
                                          <div class="col-md-6">
                                            <div class="control-box">
                                              <div class="fw-medium">App Control</div>
                                              <div class="icon-group d-flex  flex-wrap">
                                                <img src="{{URL::asset('front/images/products/new-images/wifi.png')}}" alt="Smart Life">
                                              </div>
                                            </div>
                                          </div>
                                    
                                          <!-- Third Party Control -->
                                          <div class="col-md-6">
                                            <div class="control-box">
                                              <div class="fw-medium">Third Party Control</div>
                                              <div class="icon-group d-flex flex-wrap">
                                                <img src="{{URL::asset('front/images/products/new-images/third.png')}}" alt="Amazon Alexa">
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    
                                      </div>
                                    <div class="tf-product-info-choose-option">
                                        <div class="variant-picker-item">
                                            <div class="variant-picker-label mb_12">
                                                Colors:<span class="text-title variant-picker-label-value value-currentColor">Gray</span>
                                            </div>
                                            <div class="variant-picker-values">
                                                <input id="values-beige" type="radio" name="color1">
                                                <label class="hover-tooltip tooltip-bot radius-60 color-btn" for="values-beige" data-value="Beige" data-color="beige">
                                                    <span class="btn-checkbox bg-color-beige1"></span>
                                                    <span class="tooltip">Beige</span>
                                                </label>
                                                <input id="values-gray" type="radio" name="color1" checked>
                                                <label class="hover-tooltip tooltip-bot radius-60 color-btn" data-price="79.99" for="values-gray" data-value="Gray" data-color="gray">
                                                    <span class="btn-checkbox bg-color-gray"></span>
                                                    <span class="tooltip">Gray</span>
                                                </label>
                                                <input id="values-grey" type="radio" name="color1">
                                                <label class="hover-tooltip tooltip-bot radius-60 color-btn" data-price="89.99" for="values-grey" data-value="Grey" data-color="grey">
                                                    <span class="btn-checkbox bg-color-grey"></span>
                                                    <span class="tooltip">Grey</span>
                                                </label>
                                            </div>
                                            <div id="stock-display" class="mt-2 fw-medium text-stock">64 in stock</div>
                                        </div>

                                        <div class="tf-product-info-quantity">
                                            <div class="title mb_12">Quantity:</div>
                                        
                                            <div class="row">
                                                <div class="wg-quantity col-4">
                                                    <span class="btn-quantity btn-decrease">-</span>
                                                    <input class="quantity-product" type="text" name="number" value="1">
                                                    <span class="btn-quantity btn-increase">+</span>
                                                </div>
                                        
                                                <div class="tf-product-info-by-btn mb_10 col-5">
                                                    <a href="#shoppingCart" data-bs-toggle="modal" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart">
                                                        <span>Add to cart -&nbsp;</span>
                                                        <span class="tf-qty-price total-price">$79.99</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="tf-product-info-sku">
                                            <li>
                                                <p class="text-caption-1">SKU:</p>
                                                <p class="text-caption-1 text-1">LL-TRSP-XX-CCT-6</p>
                                            </li>
                                            <li>
                                                <p class="text-caption-1">Categories:</p>
                                                <p class="text-caption-1 text-1">LED Track Lights , New Produts , Track Spotlights</p>
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
                                        <img class="lazyload" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}">
                                    </div>
                                    <div class="content">
                                        <div class="text-title">
                                            LED Track Spotlight CCT 6W 30°
                                        </div>
                                        <div class="text-caption-1 text-secondary-2">LED</div>
                                        <div class="text-title">$68.00</div>
                                    </div>
                                </div>
                                <div class="tf-sticky-atc-infos">
                                     
                                    <div class="tf-sticky-atc-quantity d-flex gap-12 align-items-center">
                                        <div class="tf-sticky-atc-infos-title text-title">Quantity:</div>
                                        <div class="wg-quantity style-1">
                                            <span class="btn-quantity minus-btn">-</span>
                                            <input type="text" name="number" value="1">
                                            <span class="btn-quantity plus-btn">+</span>
                                        </div>
                                    </div>
                                    <div class="tf-sticky-atc-btns">
                                        <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn w-100 btn-reset radius-4 btn-add-to-cart"><span class="text text-btn-uppercase">Add To Cart</span></a>
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
                                    <span class="inner">Controllers</span>
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
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active">
                                    <div class="tab-description">
                                        <div class="right">
                                            <div class="letter-1 text-btn-uppercase mb_12">LED Track Spotlight CCT 6W 30°</div>
                                            <p class="mb_12 text-secondary">This 6W CCT track spotlight produces a tuneable white from 2700K up to 6500K, with 0~100% flicker free dimming.  Both the track light and track rail are available in both black or white.  The track lights are held into the track using strong magnets.</p>
                                            <p class="mb_12 text-secondary">Individual or groups (zones) of lights can be controlled by a handheld remote control or wireless wall plate.  The setup takes seconds and requires no complex installation of control wires.  With the optional WiFi Gateway the user can also control the lights through either the tuya or smartlife app.  Additionally the user can also control the lights using Google Assistant or Amazon Alexa, as well as IFTTT.  Custom lighting scenes, colour changing programs and scheduling can be utilised within the app.  DMX control can also be incorporated with the use of the RF to DMX512 Signal Converter.</p>
                                            <p class="mb_12 text-secondary">Our LED track lighting system is ideally suited to retail, commercial and residential applications.  Almost unlimited light colour choices whilst being simple to install and operate.</p>
                                            <p class="mb_12 text-secondary">The lights are paired with the desired controller following a simple procedure.  Individual lights can be added or removed from one track to another by repeating the procedure.  These lights operate through a MESH network, whereby each light receives and passes on the control signal.  This creates an almost infinite range provided at least on light is within 30m of another light.  There is no limit to the number of lights or controllers, remotes, wall plates and app based control can be used in conjunction with each other.  We also offer LED strip light, floodlights and a range of outdoor lights that can be integrated into the same control system.</p>
                                            <p class="mb_12 text-secondary">As these lights operate from 48VDC, there is zero chance of electric shock.  This allows the light’s position or configuration to be changed by a home owner or shop assistant.  We stock a range of 48V LED drivers with factory fitted mains plug for easy installation.</p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="widget-content-inner">
                                    <div >
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Product Specifications</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Function</th>
                                                            <td>Track Spotlight</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">LED Chip Colour</th>
                                                            <td>White (2700 ~ 6500K°)</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Power</th>
                                                            <td>6W</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Beam Angle</th>
                                                            <td>30°</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Luminous Flux</th>
                                                            <td>520 LM</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Luminous Efficiency	</th>
                                                            <td>86 LM/W</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Voltage</th>
                                                            <td>48 VDC</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Control</th>
                                                            <td>Remote Control (RF 2.4GHz 6dBm)
                                                                WiFi (optional)
                                                                DMX (optional)</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Control Distance</th>
                                                            <td>30m</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Wiring</th>
                                                            <td>2 Wire</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Environmental Rating	</th>
                                                            <td>IP20</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Housing Material</th>
                                                            <td>Aluminium</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Working Temp.</th>
                                                            <td>-10 ∼ 40°C</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Dimensions</th>
                                                            <td>See diagram</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="widget-content-inner">
                                    <div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Available Controllers</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Single or Dual Colour (CCT) Dimmer Remote</li>
                                                    <li class="list-group-item">CCT Wireless Wallplate</li>
                                                    <li class="list-group-item">RF to WiFi Gateway</li>
                                                    <li class="list-group-item">RF to DMX512 Signal Converter</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="widget-content-inner">
                                    <a href="https://lcwlighting.com/uploads/admin/products/product_document/1738581809_67a0a731b463e.pdf" class="dwn btn btn-info" style="width:160px;color:white;font-size:14px" target="_blank">
                                        <i class="fa fa-download"></i>     
                                        Download    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product_Description_Tabs -->

        <!-- Ralated Products -->
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
                        <div class="swiper-slide">
                            <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s">
                                <div class="card-product-wrapper">
                                    <a href="javascript:;" class="product-img">
                                        <img class="lazyload img-product"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-1.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-1.jpg')}}" alt="image-product">
                                        <img class="lazyload img-hover"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-1.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-1.jpg')}}" alt="image-product">
                                    </a>
        
                                    <div class="list-product-btn">
                                        <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </a>
        
                                    </div>
                                    <div class="list-btn-main">
                                        <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Add To Cart</a>
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="javascript:;" class="title link">Black Hole</a>
                                    <span class="price">$39.99</span>
                                </div>
                            </div>
                        </div>
                        <!-- 2 -->
                        <div class="swiper-slide">
                            <div class="card-product wow fadeInUp" data-wow-delay="0.1s">
                                <div class="card-product-wrapper">
                                    <a href="javascript:;" class="product-img">
                                        <img class="lazyload img-product"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-2.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-2.jpg')}}" alt="image-product">
                                        <img class="lazyload img-hover"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-2.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-2.jpg')}}" alt="image-product">
                                    </a>
        
                                    <div class="list-product-btn">
                                        <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </a>
        
                                    </div>
                                    <div class="list-btn-main">
                                        <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Add To Cart</a>
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="javascript:;" class="title link">Cup</a>
                                    <span class="price">$64.13</span>
        
                                </div>
                            </div>
                        </div>
                        <!-- 3 -->
                        <div class="swiper-slide">
                            <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0.2s">
                                <div class="card-product-wrapper">
                                    <a href="javascript:;" class="product-img">
                                        <img class="lazyload img-product"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-3.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-3.jpg')}}" alt="image-product">
                                        <img class="lazyload img-hover"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-3.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-3.jpg')}}" alt="image-product">
                                    </a>
                                    <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
        
                                    <div class="list-product-btn">
                                        <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </a>
        
                                    </div>
                                    <div class="list-btn-main">
                                        <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Add To Cart</a>
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="javascript:;" class="title link">Scania</a>
                                    <span class="price"><span class="old-price">$129.99</span>$98.00</span>
        
                                </div>
                            </div>
                        </div>
                        <!-- 4 -->
                        <div class="swiper-slide">
                            <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0.3s">
                                <div class="card-product-wrapper">
                                    <a href="javascript:;" class="product-img">
                                        <img class="lazyload img-product"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-4.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-4.jpg')}}" alt="image-product">
                                        <img class="lazyload img-hover"
                                            data-src="{{URL::asset('front/images/products/new-images/best-sell-4.jpg')}}"
                                            src="{{URL::asset('front/images/products/new-images/best-sell-4.jpg')}}" alt="image-product">
                                    </a>
                                    <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
        
                                    <div class="list-product-btn">
                                        <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </a>
        
                                    </div>
                                    <div class="list-btn-main">
                                        <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Add To Cart</a>
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="javascript:;" class="title link">Step</a>
                                    <span class="price"><span class="old-price">$200.00</span>$150.00</span>
        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
                </div>

            </div>
        </section>
        <!-- /Ralated Products -->

        @include ("Front.includes.footer")

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