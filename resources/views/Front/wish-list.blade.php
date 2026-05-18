@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")
        
        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/section/page-title.jpg);  background-color:#f4f3ee">
            <div class="container">
                <h3 class="heading text-center">Your Wishlist</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="{{ url('') }}">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" >Shop</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </div>
        <!-- /page-title -->
        <!-- Section product -->
        <section class="flat-spacing">
            <div class="container">
                <div class="tf-grid-layout tf-col-2 md-col-3 xl-col-4">
                    <!-- card product 1 -->
                    <div class="card-product wow fadeInUp" data-wow-delay="0s" data-availability="Out of stock" data-brand="adidas">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}" class="product-img">
                                <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                <img class="lazyload img-hover" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                            </a>
                            <div class="list-product-btn">
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Wishlist</span>
                                </a>
                                
                            </div>
                            <div class="list-btn-main">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div> 
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}" class="title link">LED Track Spotlight CCT 6W 30°</a>
                            <span class="price current-price">$59.99</span>
                        </div>
                    </div>
                    <!-- card product 2 -->
                    <div class="card-product wow fadeInUp" data-wow-delay="0.1s" data-availability="In stock" data-brand="nike">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}" class="product-img">
                                <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                <img class="lazyload img-hover" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
                            
                            <div class="list-product-btn">
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Wishlist</span>
                                </a>
                                
                            </div>
                            <div class="list-btn-main">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div> 
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}" class="title link">LED Track Spotlight RGB+CCT 6W 30°</a>
                            <div class="price"><span class="old-price">$65.00</span> <span class="current-price">$79.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Black</span>
                                    <span class="swatch-value bg-main"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/mens/men-18.jpg" src="images/products/mens/men-18.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch line active">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/womens/women-167.jpg" src="images/products/womens/women-167.jpg" alt="image-product">
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                    <!-- card product 3 -->
                    <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0.2s" data-availability="In stock" data-brand="LV">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}" class="product-img">
                                <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                <img class="lazyload img-hover" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                            </a>
                            <div class="list-product-btn">
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Wishlist</span>
                                </a>
                                
                            </div>
                            <div class="list-btn-main">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div> 
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}" class="title link">LED Track Spotlight CCT 12W 30°</a>
                            <span class="price current-price">$75.99</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Black</span>
                                    <span class="swatch-value bg-main"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/mens/men-18.jpg" src="images/products/mens/men-18.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch line active">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/womens/women-167.jpg" src="images/products/womens/women-167.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 4 -->
                    <div class="card-product wow fadeInUp" data-wow-delay="0.3s" data-availability="Out of stock" data-brand="gucci">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}" class="product-img">
                                <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                <img class="lazyload img-hover" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                            </a>
                            
                            <div class="list-product-btn">
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Wishlist</span>
                                </a>
                                
                            </div>
                            <div class="list-btn-main">
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div> 
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}" class="title link">LED Track Spotlight RGB+CCT 12W 30°</a>
                            <span class="price current-price">$81.99</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Black</span>
                                    <span class="swatch-value bg-main"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/mens/men-18.jpg" src="images/products/mens/men-18.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch line active">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/womens/women-167.jpg" src="images/products/womens/women-167.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 5 -->
                    <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s" data-availability="Out of stock" data-brand="hermes">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}" class="product-img">
                                <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                <img class="lazyload img-hover" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                            </a>
                            <div class="list-product-btn">
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Wishlist</span>
                                </a>
                                
                            </div>
                            <div class="list-btn-main">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div> 
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}" class="title link">LED Track Spotlight CCT 25W 36°</a>
                            <span class="price current-price">$87.99</span>
                        </div>
                    </div>
                    <!-- card product 6 -->
                    <div class="card-product wow fadeInUp" data-wow-delay="0.1s" data-availability="In stock" data-brand="zalando">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}" class="product-img">
                                <img class="lazyload img-product" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                                <img class="lazyload img-hover" data-src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" src="{{URL::asset('front/images/products/new-images/LED Track Spotlight CCT 6W 30°.png')}}" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
                            
                            <div class="list-product-btn">
                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Wishlist</span>
                                </a>
                                
                            </div>
                            <div class="list-btn-main">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div> 
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}" class="title link">LED Track Spotlight RGB+CCT 25W 36°</a>
                            <div class="price"><span class="old-price">$198.00</span> <span class="current-price">$108.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Black</span>
                                    <span class="swatch-value bg-main"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/mens/men-18.jpg" src="images/products/mens/men-18.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch line active">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class=" ls-is-cached lazyloaded" data-src="images/products/womens/women-167.jpg" src="images/products/womens/women-167.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                    <!-- pagination -->
                    <ul class="wg-pagination justify-content-center">
                        <li><a href="#" class="pagination-item text-button">1</a></li>
                        <li class="active"><div class="pagination-item text-button">2</div></li>
                        <li><a href="#" class="pagination-item text-button">3</a></li>
                        <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /Section product -->
        
       
        @include ("Front.includes.footer")