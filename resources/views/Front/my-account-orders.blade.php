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
                        <h3 class="heading text-center">My Account</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="{{ url('') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                           
                            <li>
                                My Orders
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->

        <div class="btn-sidebar-account">
            <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount" ><i class="icon icon-squares-four"></i></button>
        </div>

        <!-- my-account -->
        <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                    <div class="wrap-sidebar-account">
                        <div class="sidebar-account">
                            <div class="account-avatar">
                                <div class="image">
                                    @if (!empty($data->profile_image))
                                        <img src="{{ url('/') . Storage::url($data->profile_image) }}" alt="">
                                    @else
                                        <img src="{{ URL::asset('front/images/products/new-images/Male.png') }}" alt="">
                                    @endif
                                </div>
                                <h6 class="mb_4">{{ !empty($data->full_name) ? $data->full_name : '-' }}</h6>
                                <div class="body-text-1">{{ !empty($data->email) ? $data->email : '-' }}</div>
                            </div>
                            <ul class="my-account-nav">
                                <li>
                                    <a href="{{ url('my-account') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Account Details
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('my-account-orders') }}" class="my-account-nav-item active">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Your Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('wishlist') }}" class="my-account-nav-item">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('my-account-address') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        My Address
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('logout') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16 17L21 12L16 7" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21 12H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="my-account-content">
                        <div class="account-orders">
                            <div class="wrap-account-order">
                                @if(!empty($order_data))
                                <table id="orderTable">
                                    <thead>
                                        <tr>
                                            <th class="fw-6">Sr No.</th>
                                            <th class="fw-6">Order</th>
                                            <th class="fw-6">Date</th>
                                            <th class="fw-6">Status</th>
                                            <th class="fw-6">Total</th>
                                            <th class="fw-6">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_data as $key =>$value)
                                        <tr class="tf-order-item">
                                            <td>
                                                {{ $key+1 }}
                                            </td>
                                            <td>
                                                {{!empty($value->order_id)?'#'.$value->order_id:''}}
                                            </td>
                                            <td>
                                                {{!empty($value->order_date_time)?date('F d, Y',strtotime($value->order_date_time)):''}}
                                            </td>
                                            <td>
                                                {{!empty($value->order_status)?ucwords($value->order_status):''}}
                                            </td>
                                            <td>
                                                {{!empty($value->total_amount)?'$'.number_format($value->total_amount,2):''}}

                                                {{!empty($value->total_products)?' for '.$value->total_products.' item(s)':''}}
                                                
                                            
                                            </td>
                                            <td>
                                                <a href="{{ url('my-account-orders-details') }}/{{!empty($value->id)?Crypt::encrypt($value->id):''}}" class="tf-btn btn-fill radius-4">
                                                    <span class="text">View</span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class=" text-center mt-4 p-5 bg-dark text-white rounded">
                                        <h1 class="text-center text-white">
                                        <i class="icon icon-ShoppingBagOpen"></i>
                                        </h1>
                                        <h4 class="text-center text-white">
                                            
                                            No Orders. 
                                        </h4>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /my-account -->

        @include ('Front.includes.footer')
        <!-- sidebar account-->
        <div class="offcanvas offcanvas-start canvas-sidebar" id="mbAccount">
            <div class="canvas-wrapper">
                <header class="canvas-header">
                    <span class="text-btn-uppercase">SIDEBAR ACCOUNT</span>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                </header>
                <div class="canvas-body sidebar-mobile-append"></div>
            </div>
        </div>
        <!-- End sidebar account -->
         <!-- DataTable initialization -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#orderTable').DataTable({
            "order": [[1, "desc"]],
           columnDefs: [
                { orderable: true, targets: [0] },  // Only allow sorting on the first column
                { orderable: false, targets: [1, 2, 3, 4, 5] } // Disable sorting on all other columns
            ],
            pageLength: 7,
            searching: false,
            lengthChange: false
        });
    });
</script>