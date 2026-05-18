<style>
    #sidebar-menu #side-menu li a {
        display: flex !important;
    }

    #sidebar-menu>ul>li>a i {
        line-height: unset;
    }

    .modal-content {
        border-radius: 10px !important;
    }

    .modal-header {
        border-radius: 10px 10px 0 0 !important;
    }
</style>
{{-- statrt Topbar --}}
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
       

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ !empty(Auth::guard('master_admins')->user()->user_profile_image_path) && Storage::exists(Auth::guard('master_admins')->user()->user_profile_image_path) ? url('/').Storage::url(Auth::guard('master_admins')->user()->user_profile_image_path) : URL::asset('package_assets/images/default-images/profile-image.png')}}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1"> 
                    <i class="mdi mdi-chevron-down"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome 
                        !</h6>
                    <div class="text-center mt-1" style="background-color: #f3f9ff;"><span>
                    </span></div>
                </div>

                <a href="Javascript:;" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>My Account</span>
                </a>

               

                <div class="dropdown-divider"></div>

                <a href="{{ url('admin/logout') }}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>
    </ul>

    <div class="logo-box">
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) : URL::asset('package_assets/images/construction_inventory_old.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name : '' }}" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('package_assets/images/construction_inventory_old.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" height="16">
            </span>
        </a>
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) : URL::asset('package_assets/images/construction_inventory_old.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name : '' }}" height="22">
            </span>
            <span class="logo-lg text-dark fs-4">
                <img src="{{URL::asset('package_assets/images/construction_inventory_old.png')}}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" height="65">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>

</div>
<!-- end Topbar -->

<!-- ========== Left Sidebar Start ========== -->

<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li>
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="master">
                    <a href="#master" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-pie"></i>
                        <span> Master</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="master">
                        <ul class="nav-second-level">
                            <li class="service-list country">
                                <a href="{{ url('admin/country-master') }}">
                                    <span> Country </span>
                                </a>
                            </li>
                            <li class="service-list state">
                                <a href="{{ url('admin/state-master') }}">
                                    <span> State </span>
                                </a>
                            </li>
                            <li class="service-list city">
                                <a href="{{ url('admin/city-master') }}">
                                    <span> City/Suburb </span>
                                </a>
                            </li>
                            <li class="service-list pincode">
                                <a href="{{ url('admin/pin-code-master') }}">
                                    <span> Pincode </span>
                                </a>
                            </li>
                            <li class="service-list brands">
                                <a href="{{ url('admin/brands-master') }}">
                                    <span> Brands </span>
                                </a>
                            </li>
                            <li class="service-list category">
                                <a href="{{ url('admin/category-master') }}">
                                    <span> Category </span>
                                </a>
                            </li>
                            <li class="service-list sub-category">
                                <a href="{{ url('admin/sub-category-master') }}">
                                    <span>Sub Category </span>
                                </a>
                            </li>
                            <li class="service-list sub-sub-category">
                                <a href="{{ url('admin/sub-sub-category-master') }}">
                                    <span>Sub Sub Category </span>
                                </a>
                            </li>
                            <li class="service-list gst">
                                <a href="{{ url('admin/gst-master') }}">
                                    <span>GST </span>
                                </a>
                            </li>
                            <li class="service-list product-parameter">
                                <a href="{{ url('admin/product-parameter-master') }}">
                                    <span>Product Parameter</span>
                                </a>
                            </li>
                            <li class="service-list product-parameter-value">
                                <a href="{{ url('admin/product-parameter-value-master') }}">
                                    <span>Product Parameter Value </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
                <li class="product">
                    <a href="{{ url('admin/product') }}" class="d-flex">
                        <i class="mdi mdi-package-variant-closed"></i>
                        <span> Products </span>
                    </a>
                </li>
                <li class="customer">
                    <a href="{{ url('admin/customers') }}" class="d-flex">
                        <i class="mdi mdi-account"></i>
                        <span> Customers </span>
                    </a>
                </li>
                <li class="orders">
                    <a href="{{ url('admin/orders') }}" class="d-flex">
                        <i class="mdi mdi-cart-plus"></i>
                        <span> Orders </span>
                    </a>
                </li>
                <li class="return-orders">
                    <a href="{{ url('admin/return-orders') }}" class="d-flex">
                        <i class="mdi mdi-backup-restore"></i>
                        <span>Return Orders </span>
                    </a>
                </li>
                <li class="stock">
                    <a href="{{ url('admin/stock') }}" class="d-flex">
                        <i class="mdi mdi-package-variant"></i>
                        <span> Stock Management </span>
                    </a>
                </li>
                <li class="cms">
                    <a href="#cms" data-bs-toggle="collapse">
                        <i class="mdi mdi-folder-cog"></i>
                        <span> CMS </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="cms">
                        <ul class="nav-second-level">
                            <li class="home">
                                <a href="{{ url('/admin/home') }}">
                                    <span> Home</span>
                                </a>
                            </li>
                            <li class="about">
                                <a href="{{ url('/admin/about') }}">
                                    <span> About</span>
                                </a>
                            </li>
                            <li class="faq">
                                <a href="{{ url('/admin/faq') }}">
                                    <span> FAQ"s</span>
                                </a>
                            </li>
                            <li class="pages-content">
                                <a href="{{ url('admin/pages-content') }}">
                                    <span> Pages Content</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="blogs">
                    <a href="{{ url('admin/blogs') }}" class="d-flex">
                        <i class="mdi mdi-newspaper-variant"></i>
                        <span> Blogs </span>
                    </a>
                </li>
                <li class="reports">
                    <a href="{{ url('admin/reports') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> Reports </span>
                    </a>
                </li>
                <li class="reseller">
                    <a href="{{ url('admin/reseller') }}">
                        <i class="mdi mdi-account-tie"></i>
                        <span>Reseller Enquiry</span>
                    </a>
                </li>
                <li class="training">
                    <a href="{{ url('admin/contact') }}">
                        <i class="mdi mdi-contacts"></i>
                        <span>Contact Enquiry</span>
                    </a>
                </li>
                <li class="setting">
                    <a href="#setting" data-bs-toggle="collapse">
                        <i class="mdi mdi-cog"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="nav-second-level">
                            <li class="general-setting">
                                <a href="{{ url('/admin/general-setting') }}">
                                    <span> General Settings</span>
                                </a>
                            </li>
                            <li class="visual-setting">
                                <a href="{{ url('/admin/visual-setting') }}">
                                    <span> Visual Settings</span>
                                </a>
                            </li>
                            <li class="change-password">
                                <a href="{{ url('/admin/change-password') }}">
                                    <span> Change Password</span>
                                </a>
                            </li>
                            <li class="logout">
                                <a href="{{ url('admin/logout') }}">
                                    <span> Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#supportModal">
                        <i class="mdi mdi-headset"></i>
                        <span> Application Support </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


<!-- Support modal -->
<div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> 
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="supportModalLabel">Application Support Guide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="line-height: 1.8;">
                <p>If you have any issues or concerns related to the project, they should be raised through our support
                    ticket system.</p>
                <h5><strong>Support Application URL:</strong></h5>
                <p class="mb-0"><strong>Login Link:</strong> <a href="https://support.mplussoft.com/"
                        target="_blank">https://support.mplussoft.com/</a></p>
                <p><strong>Login ID:</strong> sunnytoolingup@gmail.com<br>
                    <strong>Password:</strong> The password has been shared with your registered email ID. (If the password does not work, you can use the <a href="https://support.mplussoft.com/index.php/signin/request_reset_password" target="_blank">Forgot Password</a> option.)
                </p>
                <hr>
                <h5><strong>Steps to Raise a Ticket:</strong></h5>
                <ol>
                    <li>Go to support application link and login your account.</li>
                    <li>Go to ticket section in the menu and click on <strong>"Add ticket"</strong> button.</li>
                    <li>Fill the ticket form with necessary details and submit.</li>
                    <li>You can view all raised tickets with their status.</li>
                </ol>
            </div>
        </div>
    </div>
</div>