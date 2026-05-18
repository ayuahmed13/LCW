@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ('Front.includes.header')
<style>
    .sidebar-checkout-content .item-product .img-product {
        width: 75px !important;
        height: 75px !important;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .sidebar-checkout-content .item-product {
        align-items: flex-start !important;
    }

    .tf-select {
        position: relative;
        height: 50px;
        margin-bottom: 10px;
    }

    .tf-select::after {
        z-index: 0 !important;
    }

    .select2-container {
        height: 50px !important;
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

    .tf-btn.btn-reset:hover {
        background-color: #064953 !important;
    }

    .tf-btn:not(.btn-reset):hover {
        color: #fff;
        background-color: #064953;
    }

    .tf-btn:not(.btn-reset):hover::after,
    .tf-btn:not(.btn-reset):after {
        display: none;
    }

    .name-product {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 330px;
        /* Or a fixed width like 250px */
    }

    /* Full-page loader */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ffffffed;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Spinner */
    .spinner {
        width: 50px;
        height: 50px;
        border: 10px solid #ccc;
        border-top: 10px solid #333;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* Spinner animation */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Loader text */
    .loader-text {
        margin-top: 80px;
        font-size: 20px;
        color: #7c7c7c;
        font-family: sans-serif;
    }

    /* Optional: fade out effect */
    .loader.hidden {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, visibility 0.5s;
    }

    /* Page content (for demo) */
    .content {
        padding: 20px;
    }
</style>
<!-- page-title -->

<!-- Loader -->
<div class="loader" id="fpgloader" style="display: none;">
    <div class="spinner"></div>
    <div class="loader-text">Placing order, please wait...</div>
</div>
<div class="page-title" style="background-image: url(images/section/page-title.jpg);  background-color:#f4f3ee">
    <div class="container">
        <h3 class="heading text-center">Check Out</h3>
        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
            <li><a class="link" href="{{ url('') }}">Home</a></li>
            <li><i class="icon-arrRight"></i></li>
            <!-- <li><a class="link" >Shop</a></li> -->
            <!-- <li><i class="icon-arrRight"></i></li> -->
            <li>Checkout</li>
        </ul>
    </div>
</div>
<!-- /page-title -->
<!-- Section checkout -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="flat-spacing tf-page-checkout">
                    @if (empty(Auth::guard('master_users')->id()))
                        <div class="wrap">
                            <div class="title-login">
                                <p>Don't have an account?</p>
                                <a href="{{ url('register') }}?red=checkout" class="text-button">Register</a>
                            </div>
                            <form class="login-box" id="login-form" action="{{ url('user-login-action') }}"
                                method="post">
                                <h5 class="title">Login here</h5>
                                @csrf
                                <input type="hidden" name="redirect_to" value="checkout">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <input type="email" placeholder="Email Address*" name="email">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <input type="password" placeholder="Password*" name="password">

                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12 mt-4">
                                        <button class="tf-btn" type="submit" id="btn-submit"><span
                                                class="text">Login</span></button>

                                    </div>

                                </div>
                            </form>
                        </div>
                    @else
                        <form class="info-box" id="formA" action="{{ url('order/place-order') }}" method="post">
                            @csrf
                            <input type="hidden" name="sub_total" value="">
                            <input type="hidden" name="grand_total" value="">
                            <input type="hidden" name="gst_amount" value="">
                            <div class="wrap mb-2">
                                <h5 class="title">Billing Address</h5>
                                <div class="info-box" id="form-A">
                                    <div class="grid-2">
                                        <div class="tf-select">
                                            <select name="billing_address_type" id="billing_address_type"
                                                class="text-title" data-default="">
                                                <option
                                                    {{ !empty($default_address->address_heading) && $default_address->address_heading == '' ? 'selected' : '' }}
                                                    value="">Select Address Type</option>

                                                @if (!empty($address_type_ddl))
                                                    @foreach ($address_type_ddl as $k => $value)
                                                        <option
                                                            {{ !empty($default_address->address_heading) && !empty($value->address_heading) && $default_address->address_heading == $value->address_heading ? 'selected' : '' }}
                                                            data-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                            value="{{ !empty($value->address_heading) ? $value->address_heading : '' }}">
                                                            {{ !empty($value->address_heading) ? $value->address_heading : '' }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                                <option data-id="0" value="orher">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    @php
                                        if (!empty($default_address->name)) {
                                            $name = explode(' ', $default_address->name);
                                            $first_name = !empty($name[0]) ? $name[0] : '';
                                            $last_name = !empty($name[1]) ? $name[1] : '';
                                        }
                                    @endphp
                                    <div class="grid-2">
                                        <div>
                                            <input type="text" placeholder="First Name*"
                                                name="billing_address_first_name" id="billing_address_first_name"
                                                value="{{ !empty($first_name) ? $first_name : '' }}">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Last Name*"
                                                name="billing_address_last_name" id="billing_address_last_name"
                                                value="{{ !empty($last_name) ? $last_name : '' }}">
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div>
                                            <input type="text" placeholder="Email Address*"
                                                name="billing_address_email" id="billing_address_email"
                                                value="{{ !empty($default_address->email) ? $default_address->email : '' }}">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Phone Number*"
                                                name="billing_address_phone" id="billing_address_phone"
                                                value="{{ !empty($default_address->phone) ? $default_address->phone : '' }}">
                                        </div>
                                    </div>

                                    <div class="grid-2">
                                        <div class="tf-select">
                                            <select name="billing_address_country_region"
                                                id="billing_address_country_region" class="text-title" data-default="">
                                                <option value="">Choose Country/Region</option>
                                                @if (!empty($country_region_list))
                                                    @foreach ($country_region_list as $k => $value)
                                                        <option
                                                            {{ !empty($default_address->country_id) && $default_address->country_id == $value->id ? 'selected' : '' }}
                                                            data-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                            value="{{ !empty($value->country_name) ? $value->country_name : '' }}">
                                                            {{ !empty($value->country_name) ? $value->country_name : '' }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                        <div class="tf-select">
                                            <select name="billing_address_state" id="billing_address_state"
                                                class="text-title select2-dropdown" data-default="">
                                                @if (!empty($data['states']))
                                                    {!! $data['states'] !!}
                                                @else
                                                    <option value="">Choose State</option>
                                                @endif
                                            </select>

                                            <label id="billing_address_state-error" class="error"
                                                for="billing_address_state"></label>
                                        </div>

                                        <div class="tf-select">
                                            <select name="billing_address_town_city" id="billing_address_town_city"
                                                class="text-title select2-dropdown" data-default="">
                                                @if (!empty($data['citys']))
                                                    {!! $data['citys'] !!}
                                                @else
                                                    <option value="">Choose City</option>
                                                @endif
                                            </select>
                                            <label id="billing_address_town_city-error" class="error"
                                                for="billing_address_town_city"></label>
                                        </div>
                                        <div class="tf-select">
                                            <select name="billing_address_postal_code"
                                                id="billing_address_postal_code" class="text-title select2-dropdown"
                                                data-default="">
                                                @if (!empty($data['pincodes']))
                                                    {!! $data['pincodes'] !!}
                                                @else
                                                    <option value="">Choose Pincode</option>
                                                @endif
                                            </select>
                                            <label id="billing_address_postal_code-error" class="error"
                                                for="billing_address_postal_code"></label>
                                        </div>
                                    </div>

                                    <div class="grid-2">
                                        <input type="text" style="display: none;" placeholder="Town/City*"
                                            name="billing_address_town_city1" id="billing_address_town_city1"
                                            value="{{ !empty($default_address->city) ? $default_address->city : '' }}">
                                        <div>
                                            <input type="text" placeholder="Street,..."
                                                name="billing_address_street" id="billing_address_street"
                                                value="{{ !empty($default_address->street) ? $default_address->street : '' }}">
                                        </div>
                                    </div>
                                    <div class="grid-2" style="display: none;">
                                        <input type="text" placeholder="State*" name="billing_address_state1"
                                            id="billing_address_state1"
                                            value="{{ !empty($default_address->state) ? $default_address->state : '' }}">
                                        <input type="text" placeholder="Postal Code*"
                                            name="billing_address_postal_code1" id="billing_address_postal_code1"
                                            value="{{ !empty($default_address->pincode) ? $default_address->pincode : '' }}">
                                    </div>
                                    <textarea placeholder="Write note..." name="billing_address_note" id="billing_address_note"></textarea>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="tf-cart-checkbox">
                                    <div class="tf-checkbox-wrapp">
                                        <input checked class="" id="sameAsBilling"
                                            name="shipping_same_as_billing" onchange="toggleShipping()"
                                            type="checkbox" value="yes">
                                        <div>
                                            <i class="icon-check"></i>
                                        </div>
                                    </div>
                                    <label class="text-black fw-bold" for="login-form_agree">
                                        Same As Per Billing Address
                                    </label>
                                </div>
                            </div>
                            <div id="shippingAddress" class="wrap">
                                <h5 class="title">Shipping Address</h5>
                                <div class="info-box" id="form-B">
                                    <div class="grid-2">
                                        <div class="tf-select">
                                            <select name="shipping_address_type" id="shipping_address_type"
                                                class="text-title" data-default="">
                                                <option value="">Select Address Type</option>
                                                @if (!empty($address_type_ddl))
                                                    @foreach ($address_type_ddl as $k => $value)
                                                        <option
                                                            {{ !empty($default_address->address_heading11) && !empty($value->address_heading) && $default_address->address_heading == $value->address_heading ? 'selected' : '' }}
                                                            data-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                            value="{{ !empty($value->address_heading) ? $value->address_heading : '' }}">
                                                            {{ !empty($value->address_heading) ? $value->address_heading : '' }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                                <option data-id="0" value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div>
                                            <input type="text" placeholder="First Name*"
                                                name="shipping_address_first_name" id="shipping_address_first_name">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Last Name*"
                                                name="shipping_address_last_name" id="shipping_address_last_name">
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div>
                                            <input type="text" placeholder="Email Address*"
                                                name="shipping_address_email" id="shipping_address_email">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Phone Number*"
                                                name="shipping_address_phone" id="shipping_address_phone">
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div class="tf-select">
                                            <select class="text-title" data-default=""
                                                name="shipping_address_country_region"
                                                id="shipping_address_country_region">
                                                <option value="">Choose Country/Region</option>
                                                @if (!empty($country_region_list))
                                                    @foreach ($country_region_list as $k => $value)
                                                        <option
                                                            {{ !empty($default_address->country_id11) && $default_address->country_id == $value->id ? 'selected' : '' }}
                                                            data-id="{{ !empty($value->id) ? $value->id : '' }}"
                                                            value="{{ !empty($value->country_name) ? $value->country_name : '' }}">
                                                            {{ !empty($value->country_name) ? $value->country_name : '' }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="tf-select">
                                            <select name="shipping_address_state" id="shipping_address_state"
                                                class="text-title select2-dropdown" data-default="">
                                                @if (!empty($data['states']))
                                                    {!! $data['states'] !!}
                                                @else
                                                    <option value="">Choose State</option>
                                                @endif
                                            </select>
                                            <label id="shipping_address_state-error" class="error"
                                                for="shipping_address_state"></label>
                                        </div>

                                        <div class="tf-select">
                                            <select name="shipping_address_town_city" id="shipping_address_town_city"
                                                class="text-title select2-dropdown" data-default="">
                                                @if (!empty($data['citys']))
                                                    {!! $data['citys'] !!}
                                                @else
                                                    <option value="">Choose City</option>
                                                @endif
                                            </select>
                                            <label id="shipping_address_town_city-error" class="error"
                                                for="shipping_address_town_city"></label>
                                        </div>
                                        <div class="tf-select">
                                            <select name="shipping_address_postal_code"
                                                id="shipping_address_postal_code" class="text-title select2-dropdown"
                                                data-default="">
                                                @if (!empty($data['pincodes']))
                                                    {!! $data['pincodes'] !!}
                                                @else
                                                    <option value="">Choose Pincode</option>
                                                @endif
                                            </select>
                                            <label id="shipping_address_postal_code-error" class="error"
                                                for="shipping_address_postal_code"></label>
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div style="display:none;">
                                            <input style="display:none;" type="text" placeholder="Town/City*"
                                                name="1shipping_address_town_city" id="1shipping_address_town_city">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Street,..."
                                                name="shipping_address_street" id="shipping_address_street">
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div>
                                            <input style="display:none;" type="text" placeholder="State*"
                                                name="1shipping_address_state" id="1shipping_address_state">
                                        </div>
                                        <div>
                                            <input style="display:none;" type="text" placeholder="Postal Code*"
                                                name="1shipping_address_postal_code"
                                                id="1shipping_address_postal_code">
                                        </div>
                                    </div>
                                    <textarea placeholder="Write note..." name="shipping_address_note" id="shipping_address_note"></textarea>
                                </div>
                            </div>
                            <div class="wrap">
                                <h5 class="title">Choose payment Option:</h5>
                                <div class="form-payment" id="form-C">
                                    <div class="payment-box" id="payment-box">
                                        <div class="payment-item">
                                            <label for="apple-method" class="payment-header collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#apple-payment"
                                                aria-controls="apple-payment">
                                                <input type="radio" name="payment_method"
                                                    class="tf-check-rounded pay-method" id="apple-method"
                                                    value="online">
                                                <span class="text-title apple-pay-title"> Online Payment</span>
                                            </label>
                                            <div id="apple-payment" class="collapse" data-bs-parent="#payment-box">
                                            </div>
                                        </div>
                                        <div class="payment-item">
                                            <label for="delivery-method" class="payment-header collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#delivery-payment"
                                                aria-controls="delivery-payment">
                                                @if (!empty($bank_data))
                                                    <input type="radio" name="payment_method"
                                                        class="tf-check-rounded pay-method" id="delivery-method"
                                                        value="bank_transfer">
                                                @endif
                                                <span class="text-title">Direct Bank Transfer</span>
                                            </label>
                                            <p style="font-size: 12px; margin: -12px 0 0 40px; line-height: initial;"
                                                class="mb-2">Make your payment directly into our bank account. Please
                                                use
                                                your Order ID as the payment reference. Your order will not be shipped
                                                until
                                                the funds have cleared in our account.</p>
                                            <div id="delivery-payment" class="collapse"
                                                data-bs-parent="#payment-box">
                                            </div>

                                        </div>

                                        <label id="payment_method-error" class="error" for="payment_method"></label>
                                        @if (!empty($bank_data))
                                            <div id="bank-data" class="card" style="display: none;">
                                                <div class="card-header h5 text-white bg-dark">
                                                    Bank Account Details
                                                </div>
                                                <div class="card-body bg-white">
                                                    <ul>
                                                        <li><label class="label"><b>Account Name: </b></label>
                                                            {{ !empty($bank_data->account_name) ? $bank_data->account_name : '-' }}
                                                        </li>
                                                        <li><label class="label"><b>BSB: </b></label>
                                                            {{ !empty($bank_data->bsb) ? $bank_data->bsb : '-' }}</li>
                                                        <li><label class="label"><b>Account Number: </b></label>
                                                            {{ !empty($bank_data->account_number) ? $bank_data->account_number : '-' }}
                                                        </li>
                                                        <li><label class="label"><b>Bank Name: </b></label>
                                                            {{ !empty($bank_data->bank_name) ? $bank_data->bank_name : '-' }}
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="tf-btn btn-reset" id="placeOrder">Make Payment</button>

                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-xl-1">
                <div class="line-separation"></div>
            </div>
            <div class="col-xl-5">
                <div class="flat-spacing flat-sidebar-checkout">
                    <div class="sidebar-checkout-content">
                        <h5 class="title">Shopping Cart</h5>
                        <div class="list-product">
                            @php
                                $is_not_available = '';
                            @endphp
                            @if (!empty($cart_products))
                                @foreach ($cart_products as $key => $value)
                                    @php
                                        if (!empty($value['product_status']) && $value['product_status'] != 'active') {
                                            $is_not_available = 'yes';
                                        }
                                        if (!empty($value['is_available']) && $value['is_available'] != 'available') {
                                            $is_not_available = 'yes';
                                        }
                                    @endphp
                                    <div class="item-product">
                                        <a href="{{ url('product-detail') }}/{{ !empty($value['slug_url']) ? $value['slug_url'] : '' }}"
                                            class="img-product">
                                            <img src="{{ !empty($value['product_main_image']) && Storage::exists($value['product_main_image']) ? url('/') . Storage::url($value['product_main_image']) : URL::asset('front/images/default-img.jpg') }}"
                                                alt="img-product">
                                        </a>
                                        <div class="content-box">
                                            <div
                                                class="info {{ (!empty($value['product_status']) && $value['product_status'] != 'active') || (!empty($value['is_available']) && $value['is_available'] != 'available') || empty($value['current_stock']) ? 'not_available' : '' }}">
                                                <a href="{{ url('product-detail') }}/{{ !empty($value['slug_url']) ? $value['slug_url'] : '' }}"
                                                    class="name-product link text-title">
                                                    {{ !empty($value['name']) ? $value['name'] : '' }}
                                                    @if (
                                                        (!empty($is_not_available) && $is_not_available == 'yes') ||
                                                            (!empty($value['is_available']) && $value['is_available'] != 'available') ||
                                                            empty($value['current_stock']))
                                                        <br><label class="text-danger"> <b>( Not Available )</b>
                                                        </label>
                                                    @endif
                                                </a>
                                                <div class="variant text-caption-1 text-secondary"><span
                                                        class="size"></span><span class="color"></span></div>
                                            </div>
                                            <div class="total-price text-button"><span
                                                    class="count">{{ !empty($value['quantity']) ? $value['quantity'] : '' }}</span>X<span
                                                    class="price">{{ !empty($value['price']) ? number_format($value['price'], 2) : '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if (
                                    (!empty($is_not_available) && $is_not_available == 'yes') ||
                                        (!empty($value['is_available']) && $value['is_available'] != 'available') ||
                                        empty($value['current_stock']))
                                    <div class="alert alert-danger h6 mt-4 text-center">
                                        <i class="icon icon-ShoppingBagOpen"></i> ! Some products in your cart are not
                                        available.
                                    </div>
                                @endif

                            @endif
                        </div>

                        <div class="sec-total-price">
                            <div class="top">
                                <div class="item d-flex align-items-center justify-content-between text-button">
                                    <span>Sub Total</span>
                                    <span>${{ !empty($sub_total_without_tax) ? number_format($sub_total_without_tax, 2) : '' }}</span>
                                </div>
                                <div class="item d-flex align-items-center justify-content-between text-button">
                                    <span>Shipping</span>
                                    <span>${{ !empty($shipping) ? number_format($shipping, 2) : '0.00' }}</span>
                                </div>
                                <div class="item d-flex align-items-center justify-content-between text-button">
                                    <span>GST ({{ !empty($gst_per) ? number_format($gst_per, 2) : '0.00' }}%)</span>
                                    <span>${{ !empty($gst_val) ? number_format($gst_val, 2) : '0.00' }}</span>
                                </div>
                            </div>
                            <div class="bottom">
                                <h5 class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <span
                                        class="total-price-checkout">${{ !empty($sub_total_with_tax) ? number_format($sub_total_with_tax, 2) : '0.00' }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Section checkout -->


@include ('Front.includes.footer')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // $(document).ready(function() {
    //     $('#billing_address_type').select2({
    //         placeholder: "Select Address Type",
    //         width: '100%' // Ensures it fits container
    //     });
    // });

    // $(document).ready(function() {
    //     $('#shipping_address_type').select2({
    //         placeholder: "Select Address Type",
    //         width: '100%' // Ensures it fits container
    //     });
    // });

    $(document).ready(function() {
        $('#billing_address_state').select2({
            placeholder: "Choose State",
            width: '100%'
        });
    });

    $(document).ready(function() {
        $('#shipping_address_state').select2({
            placeholder: "Choose State",
            width: '100%'
        });
    });

    $(document).ready(function() {
        $('#shipping_address_town_city').select2({
            placeholder: "Choose City",
            width: '100%'
        });
    });

    $(document).ready(function() {
        $('#billing_address_town_city').select2({
            placeholder: "Choose City",
            width: '100%'
        });
    });

    $(document).ready(function() {
        $('#billing_address_postal_code').select2({
            placeholder: "Choose Pincode",
            width: '100%'
        });
    });

    $(document).ready(function() {
        $('#shipping_address_postal_code').select2({
            placeholder: "Choose Pincode",
            width: '100%'
        });
    });
</script>




<script>
    function toggleShipping() {
        const checkbox = document.getElementById("sameAsBilling");
        const shippingDiv = document.getElementById("shippingAddress");

        shippingDiv.style.display = checkbox.checked ? "none" : "block";
    }

    // Default state: unchecked, show shipping address
    window.onload = () => {
        document.getElementById("sameAsBilling").checked = false;
        toggleShipping();
    };
</script>

<script>
    $(document).ready(function() {
        // Add custom method for phone
        $.validator.addMethod("phone", function(value, element) {
            return this.optional(element) || /^[0-9\-+\s()]+$/.test(value);
        }, "Please enter a valid phone number");

        // Add method for country validation
        $.validator.addMethod("notEqual", function(value, element, param) {
            return value !== param;
        }, "Please select a valid option");

        // Initialize validation
        $("#formA").validate({
            rules: {
                // Billing Address
                billing_address_type: "required",
                billing_address_first_name: "required",
                billing_address_last_name: "required",
                billing_address_email: {
                    required: true,
                    email: true
                },
                billing_address_phone: {
                    required: true,
                    phone: true
                },
                billing_address_country_region: {
                    required: true,
                    notEqual: "Choose Country/Region"
                },
                billing_address_town_city: "required",
                billing_address_street: "required",
                billing_address_state: "required",
                billing_address_postal_code: "required",

                // Shipping Address (conditionally required)
                shipping_address_type: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    }
                },
                shipping_address_first_name: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    }
                },
                shipping_address_last_name: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    }
                },
                shipping_address_email: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    },
                    email: true
                },
                shipping_address_phone: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    },
                    phone: true
                },
                shipping_address_country_region: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    },
                    notEqual: "Choose Country/Region"
                },
                shipping_address_town_city: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    }
                },
                shipping_address_street: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    }
                },
                shipping_address_state: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    }
                },
                shipping_address_postal_code: {
                    required: function() {
                        return !$("#sameAsBilling").is(":checked");
                    }
                },

                // Payment
                payment_method: "required"
            },

            messages: {
                // Billing Address
                billing_address_type: "Please select a billing address type.",
                billing_address_first_name: "Please enter your first name.",
                billing_address_last_name: "Please enter your last name.",
                billing_address_email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address."
                },
                billing_address_phone: {
                    required: "Please enter your phone number.",
                    phone: "Please enter a valid phone number."
                },
                billing_address_country_region: "Please select a country or region.",
                billing_address_town_city: "Please select a town or city.",
                billing_address_street: "Please enter your street address.",
                billing_address_state: "Please select a state.",
                billing_address_postal_code: "Please select a postal code.",

                // Shipping Address
                shipping_address_type: "Please select a shipping address type.",
                shipping_address_first_name: "Please enter your first name.",
                shipping_address_last_name: "Please enter your last name.",
                shipping_address_email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address."
                },
                shipping_address_phone: {
                    required: "Please enter your phone number.",
                    phone: "Please enter a valid phone number."
                },
                shipping_address_country_region: "Please select a country or region.",
                shipping_address_town_city: "Please select a town or city.",
                shipping_address_street: "Please enter your street address.",
                shipping_address_state: "Please select a state.",
                shipping_address_postal_code: "Please select a postal code.",

                // Payment
                payment_method: "Please choose a payment method."
            },
            submitHandler: function(form) {

                const checkedValue = $('input[name="payment_method"]:checked').val();
                if (checkedValue === 'online') {
                    $("#placeOrder").prop("disabled", true).html(
                        '<i class="fa fa-spinner fa-spin"></i> Redirecting to payment page...');
                    $('#fpgloader').show();
                    form.action = "{{ url('create-payment') }}"; // Set your online payment URL
                    form.submit(); // Submit to new action
                } else {
                    $("#placeOrder").prop("disabled", true).html(
                        '<i class="fa fa-spinner fa-spin"></i> Placing Order Please Wait...');
                    $('#fpgloader').show();
                    form.submit(); // Proceed with form submission
                }
            }
            //$('#placeOrder').html('Placing order please wait..').attr('disabled',true);
        });
    });

    $('#placeOrder').click(function(e) {
        var is_logged = "{{ Auth::guard('master_users')->id() }}";
        if (is_logged == '') {
            toastr.error('You are not logged in.');
            e.preventDefault();
            return false;
        } else {
            var count = $('.not_available').length;

            if (count > 0) {
                e.preventDefault(); // Prevent default action
                toastr.error('Some products in cart are not available.');
                return false;
            }

            //
        }
    });
</script>

<script>
    $(document).ready(function() {
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    //minlength: 6
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 6 characters long"
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('text-danger');
                error.insertAfter(element);
            },
            errorClass: "text-danger", // Adding a class to the error messages
            submitHandler: function(form) {
                $("#btn-submit").prop("disabled", true).html(
                    '<i class="fa fa-spinner fa-spin"></i> Please Wait...');

                form.submit(); // Proceed with form submission
            }
        });
    });

    $('#billing_address_type').change(function(e) {
        var address_id = $('#billing_address_type option:selected').data('id');

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
                    $('#billing_address_state,#billing_address_town_city,#billing_address_postal_code')
                        .empty();
                    $('#billing_address_state').html('<option value=""> Select State</option>');
                    $('#billing_address_town_city').html('<option value=""> Select City</option>');
                    $('#billing_address_postal_code').html(
                        '<option value=""> Select Pincode</option>');

                    $('#billing_address_first_name').val('');
                    $('#billing_address_last_name').val('');
                    $('#billing_address_phone').val('');
                    $('#billing_address_email').val('');
                    $('#billing_address_street').val('');


                },
                success: function(response) {

                    if (response.status) {

                        // Edit_data
                        //$('#billing_address_first_name').val(response.data['edit_address']['name']);

                        const fullName = response.data['edit_address'][
                        'name']; // e.g. "John Doe" or "John"
                        const nameParts = fullName.split(' ');
                        const firstName = nameParts[0];
                        const lastName = nameParts.length > 1 ? nameParts.slice(1).join(' ') : '';

                        // Set the input values
                        $('#billing_address_first_name').val(firstName);
                        $('#billing_address_last_name').val(lastName);



                        $('#billing_address_phone').val(response.data['edit_address']['phone']);
                        $('#billing_address_email').val(response.data['edit_address']['email']);

                        $('#billing_address_country_region').val(response.data['edit_address'][
                            'country'
                        ]);
                        $('#billing_address_state').html(response.data['states']);
                        $('#billing_address_town_city').html(response.data['citys']);
                        $('#billing_address_postal_code').html(response.data['pincodes']);

                        $('#billing_address_street').val(response.data['edit_address']['street']);
                        $('#appartment').val(response.data['edit_address']['appartment']);
                        if (response.data['edit_address']['is_default'] == 'yes') {
                            $('.is_default').prop('checked', true);;
                        }
                        $('#id').val(response.data['edit_address_id']);
                    } else {
                        $('#billing_address_state,#billing_address_town_city,#billing_address_postal_code')
                            .empty();
                        $('#billing_address_state').html('<option value=""> Select State</option>');
                        $('#billing_address_town_city').html(
                            '<option value=""> Select City</option>');
                        $('#billing_address_postal_code').html(
                            '<option value=""> Select Pincode</option>');
                        $('#billing_address_first_name').val('');
                        $('#billing_address_last_name').val('');
                        $('#billing_address_phone').val('');
                        $('#billing_address_email').val('');
                        $('#billing_address_street').val('');
                    }
                }
            });
        } else {
            $('#billing_address_state,#billing_address_town_city,#billing_address_postal_code').empty();
            $('#billing_address_state').html('<option value=""> Select State</option>');
            $('#billing_address_town_city').html('<option value=""> Select City</option>');
            $('#billing_address_postal_code').html('<option value=""> Select Pincode</option>');

            $('#billing_address_first_name').val('');
            $('#billing_address_last_name').val('');
            $('#billing_address_phone').val('');
            $('#billing_address_email').val('');
            $('#billing_address_street').val('');
        }
    });

    $('#billing_address_country_region').change(function(e) {
        var country_id = $('#billing_address_country_region option:selected').data('id');

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
                    $('#billing_address_state').html('<option>Loading...</option>');
                },
                success: function(response) {
                    $('#billing_address_state').html(response);
                }
            });
        }
    });

    $('#billing_address_state').change(function(e) {
        var state_id = $('#billing_address_state option:selected').data('id');

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
                    $('#billing_address_town_city').html('<option>Loading...</option>');
                },
                success: function(response) {
                    $('#billing_address_town_city').html(response);
                }
            });
        }
    });


    $('#billing_address_town_city').change(function(e) {
        var city_id = $('#billing_address_town_city option:selected').data('id');

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
                    $('#billing_address_postal_code').html('<option>Loading...</option>');
                },
                success: function(response) {
                    $('#billing_address_postal_code').html(response);
                }
            });
        }
    });

    $('#shipping_address_type').change(function(e) {
        var address_id = $('#shipping_address_type option:selected').data('id');

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
                    $('#shipping_address_state,#shipping_address_town_city,#shipping_address_postal_code')
                        .empty();
                    $('#shipping_address_state').html('<option value=""> Select State</option>');
                    $('#shipping_address_town_city').html('<option value=""> Select City</option>');
                    $('#shipping_address_postal_code').html(
                        '<option value=""> Select Pincode</option>');
                    $('#shipping_address_first_name').val('');
                    $('#shipping_address_last_name').val('');
                    $('#shipping_address_phone').val('');
                    $('#shipping_address_email').val('');
                    $('#shipping_address_street').val('');
                },
                success: function(response) {

                    if (response.status) {

                        // Edit_data
                        //$('#shipping_address_first_name').val(response.data['edit_address']['name']);

                        const fullName = response.data['edit_address'][
                        'name']; // e.g. "John Doe" or "John"
                        const nameParts = fullName.split(' ');
                        const firstName = nameParts[0];
                        const lastName = nameParts.length > 1 ? nameParts.slice(1).join(' ') : '';

                        // Set the input values
                        $('#shipping_address_first_name').val(firstName);
                        $('#shipping_address_last_name').val(lastName);


                        $('#shipping_address_phone').val(response.data['edit_address']['phone']);
                        $('#shipping_address_email').val(response.data['edit_address']['email']);

                        $('#shipping_address_country_region').val(response.data['edit_address'][
                            'country'
                        ]);
                        $('#shipping_address_state').html(response.data['states']);
                        $('#shipping_address_town_city').html(response.data['citys']);
                        $('#shipping_address_postal_code').html(response.data['pincodes']);

                        $('#shipping_address_street').val(response.data['edit_address']['street']);

                        $('#appartment').val(response.data['edit_address']['appartment']);
                        if (response.data['edit_address']['is_default'] == 'yes') {
                            $('.is_default').prop('checked', true);;
                        }
                        $('#id').val(response.data['edit_address_id']);
                    } else {
                        $('#shipping_address_state,#shipping_address_town_city,#shipping_address_postal_code')
                            .empty();
                        $('#shipping_address_state').html(
                            '<option value=""> Select State</option>');
                        $('#shipping_address_town_city').html(
                            '<option value=""> Select City</option>');
                        $('#shipping_address_postal_code').html(
                            '<option value=""> Select Pincode</option>');
                        $('#shipping_address_first_name').val('');
                        $('#shipping_address_last_name').val('');
                        $('#shipping_address_phone').val('');
                        $('#shipping_address_email').val('');
                        $('#shipping_address_street').val('');
                    }
                }
            });
        } else {
            $('#shipping_address_state,#shipping_address_town_city,#shipping_address_postal_code').empty();
            $('#shipping_address_state').html('<option value=""> Select State</option>');
            $('#shipping_address_town_city').html('<option value=""> Select City</option>');
            $('#shipping_address_postal_code').html('<option value=""> Select Pincode</option>');
            $('#shipping_address_first_name').val('');
            $('#shipping_address_last_name').val('');
            $('#shipping_address_phone').val('');
            $('#shipping_address_email').val('');
            $('#shipping_address_street').val('');
        }
    });

    $(document).ready(function() {
        $('#shipping_address_state,#shipping_address_town_city,#shipping_address_postal_code').empty();
        $('#shipping_address_state').html('<option value=""> Select State</option>');
        $('#shipping_address_town_city').html('<option value=""> Select City</option>');
        $('#shipping_address_postal_code').html('<option value=""> Select Pincode</option>');

        $('#shipping_address_country_region').change(function(e) {
            var country_id = $('#shipping_address_country_region option:selected').data('id');

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
                        $('#shipping_address_state').html('<option>Loading...</option>');
                    },
                    success: function(response) {
                        $('#shipping_address_state').html(response);
                    }
                });
            }
        });

        $('#shipping_address_state').change(function(e) {
            var state_id = $('#shipping_address_state option:selected').data('id');

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
                        $('#shipping_address_town_city').html(
                            '<option>Loading...</option>');
                    },
                    success: function(response) {
                        $('#shipping_address_town_city').html(response);
                    }
                });
            }
        });


        $('#shipping_address_town_city').change(function(e) {
            var city_id = $('#shipping_address_town_city option:selected').data('id');

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
                        $('#shipping_address_postal_code').html(
                            '<option>Loading...</option>');
                    },
                    success: function(response) {
                        $('#shipping_address_postal_code').html(response);
                    }
                });
            }
        });
    });
</script>
<script>
    $('.pay-method').click(function(e) {
        if ($(this).is(':checked')) {
            if ($(this).val() === 'bank_transfer') {
                $('#placeOrder').html('Place Order');
                $('#bank-data').slideDown();
            } else if ($(this).val() === 'online') {
                $('#placeOrder').html('Make Payment');
                $('#bank-data').slideUp();
            }
        }
    });
</script>
