<style>
    #sidebar-menu #side-menu li a {
        display: flex !important;
    }

    #sidebar-menu>ul>li>a i {
        line-height: unset;
    }
</style>
{{-- statrt Topbar --}}
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
       

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ !empty(Auth::guard('master_admins')->user()->user_profile_image_path) && Storage::exists(Auth::guard('master_admins')->user()->user_profile_image_path) ? url('/').Storage::url(Auth::guard('master_admins')->user()->user_profile_image_path) : URL::asset('package_assets/images/default-images/profile-image.png')}}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1"> 
                    <!-- {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }}  -->
                    <i class="mdi mdi-chevron-down"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome 
                        <!-- {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }} -->
                        !</h6>
                    <div class="text-center mt-1" style="background-color: #f3f9ff;"><span>
                        <!-- {{ App\Helpers\Helpers\Helper::getRoleName() }} -->
                    </span></div>
                </div>

                <a href="Javascript:;" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>My Account</span>
                </a>

                {{-- <a href="javascript:;" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>Lock Screen</span>
                </a> --}}

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
{{--
<!-- $role_id = Auth::guard('master_admins')->user()->role_id; -->
<!-- $RolesPrivileges = App\Models\Master\Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first(); -->
<!-- @endphp--> --}}
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <!-- @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'dashboard_view')) -->
                <li>
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <!-- @endif -->
                <li class="master">
                    <a href="#master" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-pie"></i>
                        <span> Master</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="master">
                        <ul class="nav-second-level">
                            <li class="service-list">
                                <a href="{{ url('admin/country') }}">
                                    <span> Country </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/state') }}">
                                    <span> State </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/city') }}">
                                    <span> City </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/pincode') }}">
                                    <span> Pincode </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/brands') }}">
                                    <span> Brands </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/category') }}">
                                    <span> Category </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/sub-category') }}">
                                    <span>Sub Category </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/sub-sub-category') }}">
                                    <span>Sub Sub Category </span>
                                </a>
                            </li>
                            <li class="service-list">
                                <a href="{{ url('admin/GST') }}">
                                    <span>GST </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
                <li class="product">
                    <a href="{{ url('admin/product') }}" class="d-flex">
                        <i class="mdi mdi-package-variant-closed"></i>
                        <span> Product </span>
                    </a>
                </li>
                <li class="customer">
                    <a href="{{ url('admin/customer') }}" class="d-flex">
                        <i class="mdi mdi-account"></i>
                        <span> Customers </span>
                    </a>
                </li>
                <li class="orders">
                    <a href="{{ url('admin/orders') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> Orders </span>
                    </a>
                </li>
                <li class="stock">
                    <a href="{{ url('admin/orders') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> Stock Management </span>
                    </a>
                </li>
                <li class="orders">
                    <a href="{{ url('admin/orders') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> CMS </span>
                    </a>
                </li>
                <li class="blogs">
                    <a href="{{ url('admin/blogs') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> Blogs </span>
                    </a>
                </li>
                <li class="blogs">
                    <a href="{{ url('admin/blogs') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> Reports </span>
                    </a>
                </li>
                <li class="blogs">
                    <a href="{{ url('admin/blogs') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> Customer Review </span>
                    </a>
                </li>

             

                <!-- @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'system_users_view')) -->
                <li class="system-user">
                    <a href="#system-user" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle"></i>
                        <span> System Users</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="system-user">
                        <ul class="nav-second-level">
                            <!-- @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_view')) -->
                            <li class="system-user-list">
                                <a href="{{ url('admin/system-user') }}">
                                    <span> System Users </span>
                                </a>
                            </li>
                            <!-- @endif -->
                            <!-- @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_view')) -->
                            <li class="role-privileges">
                                <a href="{{ url('/admin/roles-privileges') }}">
                                    <span> Role Privileges </span>
                                </a>
                            </li>
                            <!-- @endif -->
                        </ul>
                    </div>
                </li>
                <!-- @endif -->
                <!-- @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'settings_view')) -->
                <li class="setting">
                    <a href="#setting" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-pie"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="nav-second-level">
                            <!-- @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_view')) -->
                            <li class="general-setting">
                                <a href="{{ url('/admin/general-setting') }}">
                                    <span> General Settings</span>
                                </a>
                            </li>
                            <!-- @endif -->
                            <!-- @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'visual_setting_view')) -->
                            <li class="visual-setting">
                                <a href="{{ url('/admin/visual-setting') }}">
                                    <span> Visual Settings</span>
                                </a>
                            </li>
                            <!-- @endif -->
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
                <!-- @endif -->
            </ul>
        </div>
    </div>
</div>