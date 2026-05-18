 <!-- Footer -->
 <footer id="footer" class="footer">
     <div class="footer-wrap">
         <div class="footer-body">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-3">
                         <div class="footer-infor">

                            @php
       
                                use App\Models\Master\Visual_setting;
                                use App\Models\Master\General_setting;
                                
                                $setting = General_setting::where('status', 'active')->orderBy('id', 'desc')->first();
                                $visual_setting = Visual_setting::where('status', 'active')->orderBy('id', 'desc')->first();
                                
                            @endphp

                             <div class="footer-logo">
                                 <a href="javascript:;">
                                    @php
                                        $slider_img = !empty($visual_setting->main_logo_image_path)?url('/') . Storage::url($visual_setting->main_logo_image_path):URL::asset('front/images/logo/LCW_Logo.png');
                                    @endphp
                                     <img src="{{ $slider_img }}"
                                         style="height: 100px;" alt="">
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-5">
                         <div class="footer-menu">
                             <div class="footer-col-block">
                                 <div class="footer-heading text-button footer-heading-mobile">
                                     Infomation
                                 </div>
                                 <div class="tf-collapse-content">
                                     <ul class="footer-menu-list">
                                         <li class="text-caption-1">
                                             <a href="{{ url('about') }}" class="footer-menu_item">About Us</a>
                                         </li>
                                         <li class="text-caption-1">
                                             <a href="{{ url('blogs') }}" class="footer-menu_item">Blogs</a>
                                         </li>

                                         <li class="text-caption-1">
                                             <a href="{{ url('contact') }}" class="footer-menu_item">Contact us</a>
                                         </li>
                                         <li class="text-caption-1">
                                             <a href="{{ url('faqs') }}" class="footer-menu_item">FAQ's</a>
                                         </li>
                                         <li class="text-caption-1">
                                             <a href="{{ url('glossary') }}" class="footer-menu_item">Glossary</a>
                                         </li>
                                         <li class="text-caption-1">
                                             <a href="{{ url('brand-info') }}" class="footer-menu_item">Product / Brand
                                                 Information</a>
                                         </li>
                                         <li class="text-caption-1">
                                             <a href="{{ url('terms-conditions') }}" class="footer-menu_item">Terms &
                                                 Conditions</a>
                                         </li>
                                         <li class="text-caption-1">
                                             <a href="{{ url('privacy-policy') }}" class="footer-menu_item">Privacy
                                                 Policy</a>
                                         </li>

                                     </ul>
                                 </div>
                             </div>
                             <div class="footer-col-block">
                                 <div class="footer-heading text-button footer-heading-mobile">
                                     Accounts
                                 </div>
                                 <div class="tf-collapse-content">
                                     <ul class="footer-menu-list">

                                         @if (Auth::guard('master_users')->check())
                                             <li class="text-caption-1">
                                                 <a href="{{ url('my-account') }}" class="footer-menu_item">My
                                                     account</a>
                                             </li>
                                             <li class="text-caption-1">
                                                 <a href="{{ url('my-account-orders') }}"
                                                     class="footer-menu_item">Order history</a>
                                             </li>
                                         @else
                                             <!-- <li class="text-caption-1">
                                                    <a href="{{ url('my-account') }}" class="footer-menu_item">My account</a>
                                                </li>
                                                <li class="text-caption-1">
                                                    <a href="#" class="footer-menu_item my-order-a">Order history</a>
                                                </li> -->
                                         @endif

                                         <li class="text-caption-1">
                                             <a href="{{ url('reseller') }}" class="footer-menu_item">Reseller Pricing
                                                 Registration</a>
                                         </li>

                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-4">
                         <div class="footer-infor">


                             <div class="footer-heading text-button mb-0 text-white">
                                 Address
                             </div>
                             <div class="footer-address">
                                 <p>
                                     {{ !empty($setting->address) ? $setting->address : '' }}
                                 </p>
                                 <a href="{{ !empty($setting->map_link) ? $setting->map_link : '' }}" target="_black"
                                     class="tf-btn-default fw-6">GET DIRECTION<i class="icon-arrowUpRight"></i></a>
                             </div>
                             <ul class="footer-info">
                                 <li>
                                     <i class="icon-mail"></i>
                                     <a href="mailto:{{ !empty($setting->email) ? $setting->email : '' }}">
                                         <p>{{ !empty($setting->email) ? $setting->email : '' }}</p>
                                     </a>
                                 </li>
                                 <li>
                                     <i class="icon-phone"></i>
                                     <a href="callto:{{ !empty($setting->mobile) ? $setting->mobile : '' }}">
                                         <p>{{ !empty($setting->mobile) ? $setting->mobile : '' }}</p>
                                     </a>
                                 </li>
                             </ul>
                             <ul class="tf-social-icon">

                                 <li><a href="{{ !empty($setting->facebook_url) ? $setting->facebook_url : '' }}"
                                         target="_blank"
                                         class="social-facebook"><i class="icon icon-fb"></i></a>
                                 </li>

                                 <li><a href="{{ !empty($setting->instagram_url) ? $setting->instagram_url : '' }}"
                                          target="_blank"
                                         class="social-instagram"><i class="icon icon-instagram"></i></a>
                                 </li>

                                 <li>
                                     <a href="{{ !empty($setting->linkedin_url) ? $setting->linkedin_url : '' }}"
                                        
                                         target="_blank" class="social-tiktok"><svg style="height: 20px;"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                             <path style="fill:white"
                                                 d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z" />
                                         </svg></a>
                                 </li>

                                 </li>
                             </ul>
                         </div>
                     </div>
                     <div class="col-lg-4 d-none">
                         <div class="footer-col-block">
                             <div class="footer-heading text-button footer-heading-mobile">
                                 Newletter
                             </div>
                             <div class="tf-collapse-content">
                                 <div class="footer-newsletter">
                                     <p class="text-caption-1">Sign up for our newsletter and get 10% off your
                                         first purchase</p>
                                     <div class="sib-form">
                                         <div id="sib-form-container" class="sib-form-container">
                                             <div id="error-message" class="sib-form-message-panel">
                                                 <div
                                                     class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                     <span class="sib-form-message-panel__inner-text">
                                                         Your subscription could not be saved. Please try again.
                                                     </span>
                                                 </div>
                                             </div>
                                             <div id="success-message" class="sib-form-message-panel">
                                                 <div
                                                     class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                     <span class="sib-form-message-panel__inner-text">
                                                         Your subscription has been successful.
                                                     </span>
                                                 </div>
                                             </div>
                                             <div id="sib-container"
                                                 class="sib-container--large sib-container--vertical">
                                                 <form id="sib-form" method="POST" class="form-newsletter"
                                                     action="" data-type="subscription">
                                                     <div>
                                                         <div class="sib-form-block">
                                                             <p></p>
                                                         </div>
                                                     </div>
                                                     <div>
                                                         <div class="sib-form-block">
                                                             <div class="sib-text-form-block">
                                                                 <p></p>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div>
                                                         <div class="sib-input sib-form-block">
                                                             <div class="form__entry entry_block">
                                                                 <div class="form__label-row ">
                                                                     <label class="entry__label" for="EMAIL">
                                                                     </label>
                                                                     <div class="entry__field">
                                                                         <input class="input radius-60" type="text"
                                                                             id="EMAIL" name="EMAIL"
                                                                             autocomplete="off"
                                                                             placeholder="Enter your e-mail..."
                                                                             data-required="true" required />
                                                                     </div>
                                                                 </div>
                                                                 <label
                                                                     class="entry__error entry__error--primary"></label>
                                                                 <label class="entry__specification">
                                                                 </label>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div>
                                                         <div class="sib-optin sib-form-block">
                                                             <div class="form__entry entry_mcq">
                                                                 <div class="form__label-row ">
                                                                     <div class="entry__choice">
                                                                         <label>
                                                                             <input type="checkbox"
                                                                                 class="input_replaced" value="1"
                                                                                 id="OPT_IN" name="OPT_IN" />
                                                                             <span
                                                                                 class="checkbox checkbox_tick_positive"></span>
                                                                             <span>
                                                                                 <p></p>
                                                                             </span>
                                                                         </label>
                                                                     </div>
                                                                 </div>
                                                                 <label class="entry__error entry__error--primary">
                                                                 </label>
                                                                 <label class="entry__specification">
                                                                 </label>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div>
                                                         <div class="sib-form-block">
                                                             <button
                                                                 class="sib-form-block__button sib-form-block__button-with-loader subscribe-button radius-60"
                                                                 form="sib-form" type="submit">
                                                                 <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon"
                                                                     viewBox="0 0 512 512">
                                                                     <path
                                                                         d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z" />
                                                                 </svg>
                                                                 <i class="icon icon-arrowUpRight"></i>
                                                             </button>
                                                         </div>
                                                     </div>
                                                     <input type="text" name="email_address_check" value=""
                                                         class="input--hidden">
                                                     <input type="hidden" name="locale" value="en">
                                                 </form>
                                             </div>
                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="footer-bottom">
             <div class="container">
                 <div class="row">
                     <div class="col-12">
                         <div class="footer-bottom-wrap">
                             <div class="left">
                                 <p class="text-caption-1">©2025 LCW Lighting. All Rights Reserved. Design By <a
                                         href="https://www.mplussoft.com/" target="_blank">Mplussoft</a></p>

                             </div>
                             <div class="tf-payment">
                                 <p class="text-caption-1">Payment:</p>
                                 <ul>
                                     <li>
                                         <img src="{{ URL::asset('front/images/payment/img-1.png') }}"
                                             alt="">
                                     </li>
                                     <li>
                                         <img src="{{ URL::asset('front/images/payment/img-2.png') }}"
                                             alt="">
                                     </li>
                                     <li>
                                         <img src="{{ URL::asset('front/images/payment/img-3.png') }}"
                                             alt="">
                                     </li>
                                     <li>
                                         <img src="{{ URL::asset('front/images/payment/img-4.png') }}"
                                             alt="">
                                     </li>
                                     <li>
                                         <img src="{{ URL::asset('front/images/payment/img-5.png') }}"
                                             alt="">
                                     </li>
                                     <li>
                                         <img src="{{ URL::asset('front/images/payment/img-6.png') }}"
                                             alt="">
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- /Footer -->

 <!-- <a href="#shoppingCart" data-bs-toggle="modal" class="btn-fixed-cart d-none d-lg-flex">
            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                    stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="count-box">1</span>
        </a> -->
 </div>







 <!-- Categories -->
 <div class="offcanvas offcanvas-start canvas-filter canvas-categories" id="shopCategories">
     <div class="canvas-wrapper">
         <div class="canvas-header">
             <span class="icon-left icon-filter"></span>
             <h5>Categories</h5>
             <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
         </div>
         <div class="canvas-body">
             <div class="wd-facet-categories">
                 <div role="dialog" class="facet-title collapsed" data-bs-target="#forWomen"
                     data-bs-toggle="collapse" aria-expanded="true" aria-controls="forWomen">
                     <img class="avt" src="images/avatar/women.jpg" alt="avt">
                     <span class="title">For Women</span>
                     <span class="icon icon-arrow-down"></span>
                 </div>
                 <div id="forWomen" class="collapse">
                     <ul class="facet-body">
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/new-in.jpg"
                                     alt="avt"><span class="title-sub text-caption-1 text-secondary">New
                                     in</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt"
                                     src="images/avatar/promotion.jpg" alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Promotion</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt"
                                     src="images/avatar/clothing.jpg" alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Clothing</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/shoes.jpg"
                                     alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Shoes</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/bags.jpg"
                                     alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Bags</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt"
                                     src="images/avatar/accessories.jpg" alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Accessories</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/jewelry.jpg"
                                     alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Jewelry</span></a>
                         </li>
                     </ul>
                 </div>
             </div>
             <div class="wd-facet-categories">
                 <div role="dialog" class="facet-title collapsed" data-bs-target="#forMen"
                     data-bs-toggle="collapse" aria-expanded="true" aria-controls="forMen">
                     <img class="avt" src="images/avatar/men.jpg" alt="avt">
                     <span class="title">For Men</span>
                     <span class="icon icon-arrow-down"></span>
                 </div>
                 <div id="forMen" class="collapse">
                     <ul class="facet-body">
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/men.jpg"
                                     alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Men</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/men.jpg"
                                     alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Men</span></a>
                         </li>
                     </ul>
                 </div>
             </div>
             <div class="wd-facet-categories">
                 <div role="dialog" class="facet-title collapsed" data-bs-target="#forKid"
                     data-bs-toggle="collapse" aria-expanded="true" aria-controls="forKid">
                     <img class="avt" src="images/avatar/kid.jpg" alt="avt">
                     <span class="title">For Kid</span>
                     <span class="icon icon-arrow-down"></span>
                 </div>
                 <div id="forKid" class="collapse">
                     <ul class="facet-body">
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/kid.jpg"
                                     alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Kid</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt" src="images/avatar/kid.jpg"
                                     alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Kid</span></a>
                         </li>
                     </ul>
                 </div>
             </div>
             <div class="wd-facet-categories">
                 <div role="dialog" class="facet-title collapsed" data-bs-target="#accessories"
                     data-bs-toggle="collapse" aria-expanded="true" aria-controls="accessories">
                     <img class="avt" src="images/avatar/accessories.jpg" alt="avt">
                     <span class="title">Accessories</span>
                     <span class="icon icon-arrow-down"></span>
                 </div>
                 <div id="accessories" class="collapse">
                     <ul class="facet-body">
                         <li>
                             <a href="#" class="item link"><img class="avt"
                                     src="images/avatar/accessories.jpg" alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Accessories</span></a>
                         </li>
                         <li>
                             <a href="#" class="item link"><img class="avt"
                                     src="images/avatar/accessories.jpg" alt="avt"><span
                                     class="title-sub text-caption-1 text-secondary">Accessories</span></a>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /Categories -->

 <!-- Javascript -->
 <script type="text/javascript" src="{{ URL::asset('front/js/bootstrap.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/jquery.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/swiper-bundle.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/carousel.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/bootstrap-select.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/lazysize.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/count-down.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/wow.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/multiple-modal.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/main.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/drift.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/carousel.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/zoom.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/model-viewer.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/sibforms.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/nouislider.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('front/js/shop.js') }}"></script>

 {{-- <script src="js/sibforms.js" defer></script> --}}

 <!-- Validation Js -->
 <script src="{{ URL::asset('package_assets/libs/validation/validate.min.js') }}"></script>                                                                                                                                                                                                    
 <script>
     window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
     window.LOCALE = 'en';
     window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE =
         "The information provided is invalid. Please review the field format and try again.";

     window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

     window.GENERIC_INVALID_MESSAGE =
         "The information provided is invalid. Please review the field format and try again.";

     window.translation = {
         common: {
             selectedList: '{quantity} list selected',
             selectedLists: '{quantity} lists selected'
         }
     };

     var AUTOHIDE = Boolean(0);
 </script>
 <!-- Toastr Css -->
 <link rel="stylesheet" href="{{ URL::asset('package_assets/libs/toastr/build/toastr.min.css') }}" />

 <!-- Toaster Js -->
 <script src="{{ URL::asset('package_assets/libs/toastr/build/toastr.min.js') }}"></script>

 <script>
     toastr.options = {
         "closeButton": true,
         "progressBar": true,
         "positionClass": "toast-bottom-right",
     }

     @if (Session::has('success'))
         toastr.success("{{ Session::get('success') }}");
     @endif

     @if (Session::has('info'))
         toastr.info("{{ Session::get('info') }}");
     @endif

     @if (Session::has('warning'))
         toastr.warning("{{ Session::get('warning') }}");
     @endif

     @if (Session::has('error'))
         toastr.error("{{ Session::get('error') }}");
     @endif
 </script>

 <script>
     function success_toast(title = '', message = '') {
         toastr.success(message);
     }

     function error_toast(title = '', message = '') {
         toastr.error(message);
     }
 </script>
 <script>
     $(document).ready(function() {
         $('.required-star').append('<span style="color:red"> *</span>');
     });
 </script>
 <script>
     var base_url = $('#base_url').val();
     var is_logged = "{{ Auth::guard('master_users')->id() }}";
     $('.add-to-wishlist').click(function(e) {
         var product_id = $(this).attr('data-id');
         if (is_logged == '') {
             toastr.error('You are not logged in.');
             return false;
         }
         if (product_id != '') {
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 type: "post",
                 url: base_url + "/wishlist/add-to-wishlist",
                 data: {
                     product_id: product_id
                 },
                 dataType: "json",
                 beforeSend: function() {
                     $('#content-loader').html(
                     '<i class="fa fa-spin fa-spinner"></i>Please Wait...');
                 },
                 success: function(response) {
                     if (response.status == 200) {
                         toastr.success(response.message);
                     } else {
                         toastr.error(response.message);
                     }
                     setTimeout(function() {
                         location.reload();
                     }, 4000);
                 }
             });
         }
     });
 </script>
 <script>
     $('.remove-from-wishlist').click(function(e) {
         var id = $(this).attr('data-id');
         var product_id = $(this).attr('data-productid');
         var is_logged = "{{ Auth::guard('master_users')->id() }}";;
         if (is_logged == '') {
             toastr.error('You are not logged in.');
             return false;
         }
         if (id != '') {
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 type: "post",
                 url: base_url + "/wishlist/remove-from-wishlist",
                 data: {
                     id: id,
                     product_id: product_id
                 },
                 dataType: "json",
                 beforeSend: function() {
                     $('#content-loader').html(
                     '<i class="fa fa-spin fa-spinner"></i>Please Wait...');
                 },
                 success: function(response) {
                     if (response.status == 200) {
                         toastr.success("Removed from wishlist successfully.");
                     } else {
                         toastr.error("Unable to remove from wishlist.");
                     }
                     setTimeout(function() {
                         location.reload();
                     }, 4000);
                 }
             });
         }
     });

     $('.add-to-cart').click(function(e) {
         var product_id = $(this).attr('data-product-id');
         var product_qty = 1;
         var qty_input_class = $(this).attr('data-qty-class');
         
         var qty_input = 0;
         if(qty_input_class!='' && qty_input_class!=undefined ){
            var qty_input = $('.'+qty_input_class).val(); 
            var product_qty = qty_input; 
         } 
         if(qty_input==0 || qty_input==''){
            var product_qty = 1;
         } 
         
         if (!product_id || product_id === 'undefined') {
             toastr.error("Incomplete data.");
             return false;
         }
         let product_stock = $(this).attr('data-product-stock');
         if (product_stock == '' || product_stock == 0) {
             toastr.error('Sorry! Product is out of stock.');
             return false;
         }
         if (is_logged == '') {
             // toastr.error('You are not logged in.');
             // return false;


             let id = $(this).attr('data-product-id');
             let name = $(this).attr('data-product-name');
             let price = $(this).attr('data-product-price');
             let quantity = product_qty;

             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: "{{ url('gcart/add') }}",
                 method: 'post',
                 data: {
                     id: id,
                     name: name,
                     price: price,
                     quantity: quantity
                 },
                 dataType: "json",
                 beforeSend: function() {
                     $('#content-loader').html(
                     '<i class="fa fa-spin fa-spinner"></i>Please Wait...');
                 },
                 success: function(response) {
    if (response.status == 'success') {
        // ✅ Add .tf-add-cart-success.active only if NOT inside .list-btn-main
        if (!$(e.currentTarget).closest('.no-cart').length) {
            $(".tf-add-cart-success").addClass("active");
        }

        // Always show toastr
        toastr.success(response.message);

    } else {
        toastr.error(response.message);
    }

    setTimeout(function() {
        location.reload();
    }, 3000);
},
                 error: function(xhr) {
                     $('#cart-message').html('<p style="color: red;">Failed to add to cart.</p>');
                 }
             });

         } else {
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 type: 'post',
                 url: base_url + '/cart/add-to-cart',
                 data: {
                     product_id: product_id,
                     product_qty: product_qty
                 },
                 dataType: "json",
                 beforeSend: function() {
                     $('#content-loader').html(
                     '<i class="fa fa-spin fa-spinner"></i>Please Wait...');
                 },
                 success: function(response) {
                     if (response.status == 'success') {
                         $(".tf-add-cart-success").addClass("active");
                         toastr.success(response.message);
                     } else {
                         toastr.error(response.message);
                     }
                     setTimeout(function() {
                         location.reload();
                     }, 4000);
                 },

             });
         }
     });
    

     $('.qty-minus, .qty-plus').click(function() {

         const productId = $('.ar-cart-div').attr('data-product-id');
         let name = $('.ar-cart-div').attr('data-product-name');
         let price = $('.ar-cart-div').attr('data-product-price');
         const input = $('.ar-cart-div').attr('data-product-qty');
         let currentQty = parseFloat(input);

         let max_qty = $(this).attr('data-max');

         // Determine new quantity
         if ($(this).hasClass('qty-minus') && currentQty > 1) {
             currentQty--;
         } else if ($(this).hasClass('qty-plus')) {
             currentQty++;
         } else {
             return;
         }
         if (max_qty == 0) {
             toastr.error('Product stocked out.');
             $('.product-qty-inp').val('1');
             return false;
         }
         if (currentQty > max_qty) {
             toastr.error('You reached at max quantity limit.');
             $('.product-qty-inp').val(max_qty);
             return false;
         }
         // Update UI immediately (optimistic)

         $('.ar-cart-div').attr('data-product-qty', currentQty)
         // Make AJAX request
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url: "{{ route('cart.update.quantity') }}",
             method: 'POST',
             data: {
                 name: name,
                 price: price,
                 product_id: productId,
                 quantity: currentQty
             },
             dataType: "json",
             beforeSend: function() {
                 $('#content-loader').html('<i class="fa fa-spin fa-spinner"></i>Please Wait...');
             },
             success: function(response) {
                 if (response.status === 'success') {
                     toastr.success(response.message);

                 } else {
                     toastr.error(response.message);

                 }
             },
             error: function(xhr) {
                 toastr.error('An error occurred while updating quantity');
                 //alert('An error occurred while updating quantity.');
             }
         });
     });
 </script>
 <script>
     $('.my-order-a').click(function(e) {
         toastr.error('You are not logged in.');
     });
 </script>
 </body>



 </html>