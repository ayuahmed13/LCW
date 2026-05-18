@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ('Front.includes.header')

<style>
    .modal {
        align-items: unset;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .modal::-webkit-scrollbar {
        display: none;
    }

    .modal-content {
        background-color: #fff;
        padding: 15px 30px;
        border-radius: 8px;
        /* max-width: 800px; */
        /* width: 90%; */
        position: relative;
        height: max-content;
        margin: 20px;
    }

    .error {
        display: flex !important;
    }

    .tf-select select {
        padding: 10px 16px !important;
    }

    .show-form-address,
    .edit-form-address {
        display: block !important;
    }

        .custom-select-group {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 10px !important;
    width: 100% !important;
}

.custom-select-wrapper {
    width: 100% !important;
    position: relative !important;
    height: 50px;
}

@media (min-width: 568px) {
    .custom-select-wrapper {
        width: calc(33.333% - 7px) !important; /* 3 in a row with gap */
    }
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #000000;
        line-height: 28px;
        border: 2px solid var(--line);
        -webkit-appearance: none !important;
        appearance: none;
        background-color: transparent;
        -webkit-transition: all 0.3s ease !important;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 8px 16px;
    }

    .select2-container--default .select2-selection--single {
        border: none !important;
    }

    .select2-container--open .select2-dropdown {
        top: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        display: none !important;
    } 
</style>

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
                        My Account Address
                    </li>
                </ul>
            </div>
        </div>
        <!-- /page-title -->

        <div class="btn-sidebar-account">
            <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount" aria-controls="offcanvas"><i
                    class="icon icon-squares-four"></i></button>
        </div>
    </div>
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
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Account Details
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('my-account-orders') }}" class="my-account-nav-item">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Your Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('wishlist') }}" class="my-account-nav-item">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('my-account-address') }}" class="my-account-nav-item active">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                My Address
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('logout') }}" class="my-account-nav-item">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                                        stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M16 17L21 12L16 7" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M21 12H9" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="my-account-content">
                <div class="account-address">
                    <div class="widget-inner-address">
                        <button class="tf-btn btn-fill radius-4 mb_20 btn-address" onclick="toggleForm()">
                            <span class="text text-caption-1">Add new address</span>
                        </button>

                        <div class="list-account-address text-center">
                            @if (!empty($address_list))
                                @foreach ($address_list as $key => $value)
                                    <div class="account-address-item">
                                        @if (!empty($value->is_default) && $value->is_default == 'yes')
                                            <p class="default-badge">Default</p>
                                        @endif
                                        <h6 class="mb_20">{{ $value->address_heading }}</h6>
                                        <p>{{ !empty($value->name) ? $value->name : '' }}</p>
                                        <p>
                                            {{ !empty($value->address) ? $value->address . ', ' : '' }}
                                            {{ !empty($value->street) ? $value->street . ', ' : '' }}
                                            {{ !empty($value->appartment) ? $value->appartment . ', ' : '' }}
                                            {{ !empty($value->pincode) ? $value->pincode : '' }}

                                        </p>
                                        <p>
                                            {{ !empty($value->state) ? $value->state : '' }}

                                        </p>
                                        <p>{{ !empty($value->email) ? $value->email : '' }}</p>
                                        <p class="mb_10">{{ !empty($value->phone) ? $value->phone : '' }}</p>
                                        <div class="d-flex gap-10 justify-content-center">
                                            <button data-id = "{{ !empty($value->id) ? $value->id : '' }}"
                                                class="tf-btn radius-4 btn-fill justify-content-center btn-edit-address"
                                                data-heading="{{ !empty($value->address_heading) ? $value->address_heading : '' }}"
                                                data-name="{{ !empty($value->name) ? $value->name : '' }}"
                                                data-email="{{ !empty($value->email) ? $value->email : '' }}"
                                                data-phone="{{ !empty($value->phone) ? $value->phone : '' }}"
                                                data-state="{{ !empty($value->state) ? $value->state : '' }}"
                                                data-company="{{ !empty($value->company) ? $value->company : '' }}"
                                                data-address="{{ !empty($value->address) ? $value->address : '' }}"
                                                data-city="{{ !empty($value->city) ? $value->city : '' }}"
                                                data-street="{{ !empty($value->street) ? $value->street : '' }}"
                                                data-appartment="{{ !empty($value->appartment) ? $value->appartment : '' }}"
                                                data-pincode="{{ !empty($value->pincode) ? $value->pincode : '' }}"
                                                data-id="{{ !empty($value->id) ? Crypt::encrypt($value->id) : '' }}"
                                                id="address_{{ $value->id }}">
                                                <span class="text">Edit</span>
                                            </button>
                                            <a href="{{ url('my-account-address/delete') }}/{{ Crypt::encrypt($value->id) }}"
                                                onclick="return confirm('Do you really want to delete?')">
                                                <button class="tf-btn radius-4 btn-outline justify-content-center">
                                                    <span class="text">Delete</span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- Popup Modal Form -->
                        <div id="popupForm" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="toggleForm()">&times;</span>

                                <!-- Your form here -->
                                <form class="show-form-address" name="addressForm" id="addressForm"
                                    action="{{ url('my-account-address/store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="">

                                    <div class="title text-left mb_20 fs-4" style="text-align: left !important;">Add
                                        New Address</div>
                                    <div class="cols mb_20" style="width: 50% !important">
                                        <fieldset><input type="text" placeholder="Address Heading*"
                                                name="address_heading" id="address_heading"></fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset><input type="text" placeholder=" Name*" name="name"
                                                id="name" onkeypress="return /[a-z A-Z]/i.test(event.key)">
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset><input type="email" placeholder="Email Address*" name="email"
                                                id="email"></fieldset>
                                        <fieldset><input type="text" placeholder="Phone*" name="phone"
                                                id="phone" onkeypress="return /[0-9]/i.test(event.key)"
                                                maxlength="15"></fieldset>
                                    </div>
                                    <div class="tf-select mb_20 d-flex gap-2" style="width: 100% !important">

                                        <div class="w-100">
                                            <input type="text" placeholder="Company Name (Optional)"
                                                name="company" id="company">
                                        </div>
                                    </div>
                                    <div class="tf-select mb_20 custom-select-group" style="width: 100% !important">
                                        <div class="custom-select-wrapper position-relative w-50">
                                            <select class="text-title form-select" name="country" id="country"
                                                style="border-radius: 5px !important; padding-right: 2.5rem;">
                                                <option value="">Select Country</option>
                                                @if (!empty($country_region_list))
                                                    @foreach ($country_region_list as $k => $value)
                                                        <option data-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                            value="{{ !empty($value->country_name) ? $value->country_name : '' }}">
                                                            {{ !empty($value->country_name) ? $value->country_name : '' }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <i
                                                class="bi bi-caret-down-fill position-absolute end-0 top-50 translate-middle-y me-3 text-muted pointer-events-none"></i>
                                        </div>

                                        <div class="custom-select-wrapper position-relative w-50">
                                            <select class="text-title select2-dropdown" name="state" id="state" data-default=""
                                                style="border-radius: 5px !important">
                                                <option value="">Select State</option>
                                                @if (!empty($state_list))
                                                    @foreach ($state_list as $k => $value)
                                                        <option data-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                            value="{{ !empty($value->state_name) ? $value->state_name : '' }}">
                                                            {{ !empty($value->state_name) ? $value->state_name : '' }}
                                                        </option>
                                                    @endforeach
                                                @endif


                                            </select>
                                            <i
                                                class="bi bi-caret-down-fill position-absolute end-0 top-50 translate-middle-y me-3 text-muted pointer-events-none"></i>
                                        </div>

                                        <div class="custom-select-wrapper position-relative w-50">
                                            <select class="text-title select2-dropdown" name="city" id="city" data-default=""
                                                style="border-radius: 5px !important">
                                                <option value="">Select City</option>
                                                @if (!empty($city_list))
                                                    @foreach ($city_list as $k => $value)
                                                        <option
                                                            value="{{ !empty($value->country_name) ? $value->country_name : '' }}">
                                                            {{ !empty($value->country_name) ? $value->country_name : '' }}
                                                        </option>
                                                    @endforeach
                                                @endif


                                            </select>
                                            <i
                                                class="bi bi-caret-down-fill position-absolute end-0 top-50 translate-middle-y me-3 text-muted pointer-events-none"></i>
                                        </div>
                                    </div>

                                    

                                    <fieldset class="mb_20">
                                        <input type="text" placeholder="Address*" name="address" id="address">
                                    </fieldset>
                                    <div class="cols mb_20">

                                        <fieldset><input type="text" placeholder="Street*" name="street"
                                                id="street"></fieldset>
                                    </div>

                                    <div class="cols">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="Apartment*"
                                                name="appartment" id="appartment" tabindex="2">
                                        </fieldset>
                                        <div class="tf-select mb_20 d-flex gap-2" style="width: 100% !important">
                                            <div class="position-relative w-100" style="">
                                                <select class="text-title" name="pincode" id="pincode"
                                                    data-default="" style="border-radius: 5px !important">
                                                    <option value="">Select Pincode</option>
                                                    @if (!empty($city_list))
                                                        @foreach ($city_list as $k => $value)
                                                            <option
                                                                value="{{ !empty($value->country_name) ? $value->country_name : '' }}">
                                                                {{ !empty($value->country_name) ? $value->country_name : '' }}
                                                            </option>
                                                        @endforeach
                                                    @endif


                                                </select>
                                                <i
                                                    class="bi bi-caret-down-fill position-absolute end-0 top-50 translate-middle-y me-3 text-muted pointer-events-none"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tf-cart-checkbox mb_8 mt-2">
                                        <div class="tf-checkbox-wrapp">
                                            <input class="is_default" type="checkbox" id="CartDrawer-Form_agree"
                                                name="is_default" value="yes">
                                            <div>
                                                <i class="icon-check"></i>
                                            </div>
                                        </div>
                                        <label class="text-black" for="CartDrawer-Form_agree">
                                            Set as default address.
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center  gap-20">
                                        <button type="submit" id="btn-submit-a"
                                            class="tf-btn btn-fill radius-4"><span class="text">Add
                                                address</span></button>
                                        {{-- <span class="tf-btn btn-fill radius-4 btn-hide-address"><span class="text">Cancel</span></span> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /page-title -->

                        <div class="btn-sidebar-account">
                            <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount"
                                aria-controls="offcanvas"><i class="icon icon-squares-four"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#state').select2({
            placeholder: "Select State",
            width: '100%'
        });
    });

    $(document).ready(function() {
        $('#city').select2({
            placeholder: "Select City",
            width: '100%'
        });
    });
</script>

<script>
    function toggleForm() {
        var form = document.getElementById("popupForm");
        var isVisible = form.style.display === "flex";

        form.style.display = isVisible ? "none" : "flex";

        // Prevent background scroll when modal is open
        document.body.style.overflow = isVisible ? "auto" : "hidden";

        var $form = $('#popupForm');
        $form.find('input, textarea, select').each(function () {
            $('#state,#city').empty();
            $('#state').html('<option value=""> Select State</option>');
            $('#city').html('<option value=""> Select City</option>');
            if ($(this).attr('name') === '_token') {
                return; // Skip this field
            }
            if ($(this).is(':checkbox') || $(this).is(':radio')) {
                $(this).prop('checked', false);
            } else {
                $(this).val('');
            }
        });
    }
</script>


<script>
    var base_url = $('#base_url').val();
    $(document).ready(function() {
        // Initialize form validation
        $("#addressForm").validate({
            rules: {
                address_heading: {
                    required: true,
                    minlength: 3
                },
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 15
                },
                state: {
                    required: true
                },
                company: {
                    minlength: 3
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                street: {
                    required: true
                },
                appartment: {
                    required: true
                },
                pincode: {
                    required: true,

                },
                is_default: {
                    required: false
                }
            },
            messages: {
                address_heading: {
                    required: "Please enter an address heading.",
                    minlength: "Address heading must be at least 3 characters long."
                },
                name: {
                    required: "Please enter your name.",
                    minlength: "Name must be at least 3 characters long."
                },
                email: {
                    required: "Please enter your email.",
                    email: "Please enter a valid email address."
                },
                phone: {
                    required: "Please enter your phone number.",
                    minlength: "Phone number must be at least 10 digits long.",
                    maxlength: "Phone number must not exceed 15 digits."
                },
                state: {
                    required: "Please select a state."
                },
                company: {
                    minlength: "Company name must be at least 3 characters long."
                },
                address: {
                    required: "Please enter your address."
                },
                city: {
                    required: "Please enter your city."
                },
                street: {
                    required: "Please enter your street."
                },
                appartment: {
                    required: "Please enter your apartment name."
                },
                pincode: {
                    required: "Please select your pincode.",

                },
            },
            submitHandler: function(form) {
                // If the form is valid, submit it
                let country_id = $('#country option:selected').data('id');
                let state_id = $('#state option:selected').data('id');
                let city_id = $('#city option:selected').data('id');

                $('<input>').attr({
                    type: 'hidden',
                    name: 'country_id',
                    value: country_id
                }).appendTo(form);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'state_id',
                    value: state_id
                }).appendTo(form);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'city_id',
                    value: city_id
                }).appendTo(form);
                $('#btn-submit-a').html('Please wait ...').attr('disabled', true);
                form.submit();
            }
        });
    });
    $('.btn-edit-address').click(function(e) {

        let address_id = $(this).attr('data-id');
        if (address_id != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: base_url + "/get-address-by-id",
                data: {
                    address_id: address_id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#state,#city,#pincode').empty();
                    $('#state').html('<option value=""> Select State</option>');
                    $('#city').html('<option value=""> Select City</option>');
                    $('#pincode').html('<option value=""> Select Pincode</option>');
                },
                success: function(response) {

                    if (response.status) {
                        $('#country').val(response.data['edit_address']['country']);
                        $('#state').html(response.data['states']);
                        $('#city').html(response.data['citys']);
                        $('#pincode').html(response.data['pincodes']);

                        // Edit_data
                        $('#address_heading').val(response.data['edit_address']['address_heading']);
                        $('#name').val(response.data['edit_address']['name']);
                        $('#phone').val(response.data['edit_address']['phone']);
                        $('#email').val(response.data['edit_address']['email']);
                        $('#company').val(response.data['edit_address']['company']);
                        $('#address').val(response.data['edit_address']['address']);

                        $('#street').val(response.data['edit_address']['street']);
                        $('#appartment').val(response.data['edit_address']['appartment']);
                        if (response.data['edit_address']['is_default'] == 'yes') {
                            $('.is_default').prop('checked', true);;
                        }
                        $('#id').val(response.data['edit_address_id']);
                    }
                }
            });
        }

        var form = document.getElementById("popupForm");
        form.style.display = (form.style.display === "flex") ? "none" : "flex";
    });

    $('#country').change(function(e) {
        var country_id = $('#country option:selected').data('id');

        if (country_id != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: base_url + "/get-state-by-country-id",
                data: {
                    country_id: country_id
                },
                dataType: "html",
                beforeSend: function() {
                    $('#state').html('<option>Loading...</option>');
                },
                success: function(response) {
                    $('#state').html(response);
                }
            });
        }
    });

    $('#state').change(function(e) {
        var state_id = $('#state option:selected').data('id');

        if (state_id != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: base_url + "/get-city-by-state-id",
                data: {
                    state_id: state_id
                },
                dataType: "html",
                beforeSend: function() {
                    $('#city').html('<option>Loading...</option>');
                },
                success: function(response) {
                    $('#city').html(response);
                }
            });
        }
    });


    $('#city').change(function(e) {
        var city_id = $('#city option:selected').data('id');

        if (city_id != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: base_url + "/get-pincode-by-city-id",
                data: {
                    city_id: city_id
                },
                dataType: "html",
                beforeSend: function() {
                    $('#pincode').html('<option>Loading...</option>');
                },
                success: function(response) {
                    $('#pincode').html(response);
                }
            });
        }
    });
</script>
