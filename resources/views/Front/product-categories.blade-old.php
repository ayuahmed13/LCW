@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")
        
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
                        <button id="remove-all" class="remove-all-filters text-btn-uppercase" style="display: none;">REMOVE ALL <i class="icon icon-close"></i></button>
                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="sidebar-filter canvas-filter left">
                                <div class="canvas-wrapper">
                                    <div class="canvas-header d-flex d-xl-none">
                                        <h5>Filters</h5>
                                        <span class="icon-close close-filter"></span>
                                    </div>
                                    <div class="canvas-body">
                                        <div class="tf-shop-control">
                    

                                            <div class="tf-control-sorting">
                                                <p class="d-none d-lg-block text-caption-1">Sort by:</p>
                                                <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                                                    <div class="btn-select">
                                                        <span class="text-sort-value">Best selling</span>
                                                        <span class="icon icon-arrow-down"></span>
                                                    </div>
                                                    <div class="dropdown-menu">
                                                        <div class="select-item" data-sort-value="best-selling">
                                                            <span class="text-value-item">Best selling</span>
                                                        </div>
                                                        <div class="select-item" data-sort-value="a-z">
                                                            <span class="text-value-item">Alphabetically, A-Z</span>
                                                        </div>
                                                        <div class="select-item" data-sort-value="z-a">
                                                            <span class="text-value-item">Alphabetically, Z-A</span>
                                                        </div>
                                                        <div class="select-item" data-sort-value="price-low-high">
                                                            <span class="text-value-item">Price, low to high</span>
                                                        </div>
                                                        <div class="select-item" data-sort-value="price-high-low">
                                                            <span class="text-value-item">Price, high to low</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-facet facet-categories">
                                            <h6 class="facet-title">Product Categories</h6>
                                            <ul class="facet-content">
                                                <li><a href="#" class="categories-item">Downlights <span class="count-cate">(112)</span></a></li>
                                                <li><a href="#" class="categories-item">New Products <span class="count-cate">(32)</span> </a></li>
                                                <li><a href="#" class="categories-item">LED Strip Light <span class="count-cate">(42)</span></a></li>
                                                <li><a href="#" class="categories-item active">LED Track Lights <span class="count-cate">(6)</span></a></li>
                                                <li><a href="#" class="categories-item">Neon Flex <span class="count-cate">(13)</span></a></li>
                                                <li><a href="#" class="categories-item">LED Controllers <span class="count-cate">(52)</span></a></li>
                                                <li><a href="#" class="categories-item">Power Suppliers <span class="count-cate">(17)</span></a></li>
                                                <li><a href="#" class="categories-item">LED Profile | LED Aluminium Extrusion<span class="count-cate">(4)</span></a></li>
                                                <li><a href="#" class="categories-item">Outdoor Lights <span class="count-cate">(41)</span></a></li>
                                                <li><a href="#" class="categories-item">Sign LED Modules<span class="count-cate">(75)</span></a></li>
                                                <li><a href="#" class="categories-item">LED Accessories<span class="count-cate">(35)</span></a></li>
                                                <li><a href="#" class="categories-item">Unique Products<span class="count-cate">(20)</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="widget-facet facet-price">
                                            <h6 class="facet-title">Price</h6>
                                            <div class="price-val-range" id="price-value-range" data-min="0" data-max="500"></div>
                                            <div class="box-price-product">
                                                <div class="box-price-item">
                                                    <span class="title-price">Min price</span>
                                                    <div class="price-val" id="price-min-value" data-currency="$"></div>
                                                </div>
                                                <div class="box-price-item">
                                                    <span class="title-price">Max price</span>
                                                    <div class="price-val" id="price-max-value" data-currency="$"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="widget-facet facet-color">
                                            <h6 class="facet-title">Colors</h6>
                                            <div class="facet-color-box">
                                                <div class="color-item color-check"><span class="color bg-main"></span>Black</div>
                                                <div class="color-item color-check"><span class="color bg-white line-black"></span>White</div>           
                                            </div>
                                        </div>
                                        <div class="widget-facet facet-fieldset">
                                            <h6 class="facet-title">Availability</h6>
                                            <div class="box-fieldset-item">
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="inStock">
                                                    <label for="inStock">In stock <span class="count-stock">(32)</span></label>
                                                </fieldset>
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="outStock">
                                                    <label for="outStock">Out of stock <span class="count-stock">(2)</span></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="widget-facet facet-fieldset">
                                            <h6 class="facet-title">Input Voltage</h6>
                                            <div class="box-fieldset-item">
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="inStock">
                                                    <label for="inStock">12V DC <span class="count-stock">(4)</span></label>
                                                </fieldset>
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="outStock">
                                                    <label for="outStock">24V DC <span class="count-stock">(6)</span></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="widget-facet facet-fieldset">
                                            <h6 class="facet-title">Watts/m</h6>
                                            <div class="box-fieldset-item">
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="inStock">
                                                    <label for="inStock">9.6W/m <span class="count-stock">(4)</span></label>
                                                </fieldset>
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="outStock">
                                                    <label for="outStock">19W/m <span class="count-stock">(6)</span></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="widget-facet facet-fieldset">
                                            <h6 class="facet-title">Current Output</h6>
                                            <div class="box-fieldset-item">
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="inStock">
                                                    <label for="inStock">100mA <span class="count-stock">(4)</span></label>
                                                </fieldset>
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="outStock">
                                                    <label for="outStock">135mA <span class="count-stock">(6)</span></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="widget-facet facet-fieldset">
                                            <h6 class="facet-title">Colour Temprature</h6>
                                            <div class="box-fieldset-item">
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="inStock">
                                                    <label for="inStock">3000K <span class="count-stock">(4)</span></label>
                                                </fieldset>
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="outStock">
                                                    <label for="outStock">4000K <span class="count-stock">(6)</span></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="widget-facet facet-fieldset">
                                            <h6 class="facet-title">Mounting Method</h6>
                                            <div class="box-fieldset-item">
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="inStock">
                                                    <label for="inStock">Screw <span class="count-stock">(4)</span></label>
                                                </fieldset>
                                                <fieldset class="fieldset-item">
                                                    <input type="radio" name="availability" class="tf-check" id="outStock">
                                                    <label for="outStock">Screw <span class="count-stock">(6)</span></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="canvas-bottom d-block d-xl-none">
                                        <button id="reset-filter" class="tf-btn btn-reset">Reset Filters</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            
                            <div class="tf-grid-layout wrapper-shop tf-col-3" id="gridLayout">
                                <!-- card product 1 -->
                                <div class="card-product grid" data-availability="Out of stock" data-brand="adidas">
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
                                <div class="card-product grid" data-availability="In stock" data-brand="nike">
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
                                <div class="card-product grid" data-availability="Out of stock" data-brand="gucci">
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
                                <div class="card-product grid" data-availability="In stock" data-brand="zalando">
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
                                <div class="card-product grid" data-availability="In stock" data-brand="hermes">
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
                                <div class="card-product grid"  data-availability="In stock" data-brand="gucci">
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
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- /Section product -->
        
       
        @include ("Front.includes.footer")

        <script>
            $(".product").addClass("active");
        </script>