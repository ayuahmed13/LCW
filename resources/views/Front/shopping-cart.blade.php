@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")
<style>
.tf-cart-item .tf-cart-item_product .img-box {
    width: 75px !important;
    height: 75px !important;
    border: 1px solid rgba(0, 0, 0, 0.1);
}
.cart-title {
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 330px; /* Or a fixed width like 250px */
}
</style>
<!-- page-title -->
<div class="page-title" style="background-image: url('{{ asset('front/images/products/new-images/terms-top-banner-image.png') }}'); background-color:#f4f3ee">

    <div class="container">
        <h3 class="heading text-center">Shopping Cart</h3>
        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
            <li><a class="link" href="{{ url('') }}">Home</a></li>
            <li><i class="icon-arrRight"></i></li>
            <li>Shopping Cart</li>
        </ul>
    </div>
</div>
<!-- /page-title -->
<!-- Section cart -->
<section class="flat-spacing">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="tf-cart-sold">
                    <div class="notification-sold bg-surface">
                        <div class="count-text">
                        @if(!empty($cart_products))
                        Your cart is ready ! Just one step away from completing your purchase.
                        @if(1==3)
                        <a href="{{url('cart/empty-cart')}}" class="btn btn-sm btn-danger flex" >Empty Cart</a>
                        @endif
                        @else
                        Your cart is currently empty.
Let’s fix that! <a href="{{url('products')}}"><u>Start shopping now. <i class="fa fa-cart"></i> </u></a>
                        @endif
                        </div>

                    </div>
                </div>
               
                <form>
                    @if(!empty($cart_products))
                    <table class="tf-table-page-cart">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th style="width: 20%">Total Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             @php 
                            $is_not_available = '';
                            @endphp
                            @foreach($cart_products as $key => $value)
                            @php
                            if(!empty($value['product_status']) && $value['product_status']!='active'){
                                $is_not_available = 'yes';
                            }
                            if(!empty($value['is_available']) && $value['is_available']!='available'){
                                $is_not_available = 'yes';
                            }
                            @endphp
                            <tr id="cartrow_{{!empty($value['key_id'])?($value['key_id']):''}}" class="tf-cart-item file-delete {{((!empty($value['product_status']) && $value['product_status']!='active') || (!empty($value['is_available']) && $value['is_available']!='available') || empty($value['current_stock']))?'not_available':''}}">
                                <td class="tf-cart-item_product">
                                    <a href="{{ url('product-detail') }}/{{ !empty($value['slug_url'])?$value['slug_url']:''}}" class="img-box">
                                        <img src="{{ !empty($value['product_main_image']) && Storage::exists($value['product_main_image']) ? url('/').Storage::url($value['product_main_image']) : URL::asset('front/images/default-img.jpg') }}" alt="product">
                                    </a>
                                    <div class="cart-info">
                                        <a href="{{ url('product-detail') }}/{{ !empty($value['slug_url'])?$value['slug_url']:''}}" class="cart-title link">
                                            {{!empty($value['name'])?($value['name']):'-'}}
                                            {!! ((!empty($value['product_status']) && $value['product_status']!='active') || (!empty($value['is_available']) && $value['is_available']!='available') || empty($value['current_stock']))?'<br><label class="text-danger"> <b>( Not Available )</b> </label>':'-' !!}
                                            
                                        </a>
                                        
                                    </div>
                                </td>
                                <td data-cart-title="Price" class="tf-cart-item_price text-center">
                                    <div class="cart-price text-button price-on-sale">${{!empty($value['price'])?number_format($value['price'],2):'-'}}</div>
                                </td>
                                 
                                <td data-cart-title="Quantity" class="tf-cart-item_quantity">
                                     @if(
                                        (!empty($is_not_available) && $is_not_available=='yes') ||
                                        (!empty($value['is_available']) && $value['is_available']!='available') ||
                                        empty($value['current_stock'])
                                    )
                                    <div class="wg-quantity mx-md-auto bg-gray">
                                        <span style="cursor:not-allowed;" class="btn-quantity text-muted">-</span>
                                        <input id="qty_{{$key}}" type="text" class="quantity-product text-muted" name="product-qty" id="product-qty" min="1" value="{{!empty($value['quantity'])?($value['quantity']):'-'}}">
                                        <input type="hidden" class="ar-cart-div-a" id="arcartdiv_{{$key}}">
                                        <span style="cursor:not-allowed;" class="btn-quantity text-muted">+</span>
                                    </div>
                                    @else
                                    <div class="wg-quantity mx-md-auto">
                                        <span class="btn-quantity btn-decrease minus-qty qty-minus" data-id="plus_{{$key}}" data-min="1" data-max="{{!empty($value['current_stock'])?$value['current_stock']:0}}">-</span>
                                        <input id="qty_{{$key}}" type="text" class="quantity-product" name="product-qty" id="product-qty" min="1" value="{{!empty($value['quantity'])?($value['quantity']):'-'}}">
                                        <input type="hidden" class="ar-cart-div-a" id="arcartdiv_{{$key}}"
                                                data-product-id="{{ !empty($value['id'])?$value['id']:''}}"
                                                data-product-name="{{ !empty($value['product_name'])?$value['product_name']:''}}"
                                                data-product-price="{{ !empty($value['offer_price'])?$value['offer_price']:''}}"
                                                data-product-qty="{{ !empty($value['qty'])?$value['qty']:1}}"
                                        >
                                        <span class="btn-quantity btn-increase plus-qty qty-minus" data-id="plus_{{$key}}" data-min="1" data-max="{{!empty($value['current_stock'])?$value['current_stock']:0}}">+</span>
                                    </div>
                                    @endif
                                </td>

                                <td data-cart-title="Total" class="tf-cart-item_total text-center">
                                    <div class="cart-total text-button total-price">$
                                        {{ number_format($value['quantity']*$value['price'],2)}}
                                    </div>
                                </td>
                                <td data-cart-title="Remove" class="remove-cart" >
                                    
                                    <span class="remove icon icon-close rem-from-cart" data-id="{{!empty($value['key_id'])?($value['key_id']):''}}"></span>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                    @if(
                        (!empty($is_not_available) && $is_not_available=='yes') ||
                        (!empty($value['is_available']) && $value['is_available']!='available') ||
                        empty($value['current_stock'])
                    )
        
                     <div class="alert alert-danger h5 text-center">
                        <i class="icon icon-ShoppingBagOpen"></i> ! Some products in your cart are not available.
                    </div>
                    @endif
                    @else
                        <div class="empty-cart text-center mt-4 p-5 text-dark rounded">
                        <h1 class="text-center text-dark">
                        <i class="icon icon-ShoppingBagOpen"></i>
                        </h1>
                        <h4 class="text-center text-dark">
                            
                            Your cart is empty. 
                        </h4>

                        </div>
                      
                    @endif
                </form>
            </div>
            <div class="col-xl-4">
                <div class="fl-sidebar-cart">
                    <div class="box-order bg-surface">
                        <h5 class="title">Order Summary</h5>
                        <div class="subtotal text-button d-flex justify-content-between align-items-center">
                            <span>Subtotal</span>
                            <span class="total">$<span class="sub_total">{{!empty($sub_total_without_tax)? number_format($sub_total_without_tax,2):'0'}}<span></span>
                        </div>
                        <div class="discount text-button d-flex justify-content-between align-items-center">
                            <span>GST ({{!empty($gst_per)?number_format($gst_per,2):'0'}}%)</span>
                            <span class="total">${{!empty($gst_val)?number_format($gst_val,2):'0'}}</span>
                        </div>
                        <div class="discount text-button d-flex justify-content-between align-items-center">
                            <span class="text-button">Shipping</span>
                            <span class="total">$0.00</span>
                        </div>
                        <h5 class="total-order d-flex justify-content-between align-items-center">
                            <span>Total</span>
                            <span class="total">$<span class="grand_total">{{!empty($sub_total_with_tax)? number_format($sub_total_with_tax,2):'0'}}</span>
                        </h5>
                        <div class="box-progress-checkout">
                            <fieldset class="check-agree">
                                <input type="checkbox" id="check-agree-checkout" class="tf-check-rounded">
                                <label for="check-agree">
                                    I agree with the <a href="{{ url('terms-conditions') }}">terms and conditions</a>
                                </label>
                            </fieldset>
                            @if(!empty($cart_products))
                            <a href="{{ url('checkout') }}" class="tf-btn btn-reset process-to-checkout" >Process To Checkout</a>
                            @else
                            <label class="tf-btn btn-reset" style="background:lightgray;cursor:not-allowed;" title="No products in cart." disabled >Process To Checkout</label>
                            @endif
                            <p class="text-button text-center">Or <a href="{{url('products')}}">Continue Shopping</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Section cart -->
<!-- Recent product -->
<section class="flat-spacing pt-0">
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h4 class="heading">You may also like</h4>
        </div>
        <div dir="ltr" class="swiper tf-sw-recent" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
            <div class="swiper-wrapper">
               @if(!empty($related_products))
                @foreach($related_products as $k => $value)
                <div class="swiper-slide">
                    <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s">
                        <div class="card-product-wrapper">
                            <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url)?$value->slug_url:''}}" class="product-img">
                                <img class="lazyload img-product"
                                    data-src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    alt="image-product">
                                <img class="lazyload img-hover"
                                    data-src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    src="{{ !empty($value->product_main_image) ? url('/').Storage::url($value->product_main_image) : URL::asset('front/images/default-img.jpg') }}"
                                    alt="image-product">URL::asset('front/images/default-img.jpg')
                            </a>

                            <div class="list-product-btn">
                            @if(!empty($wishlist_product_ids) && in_array($value->id,$wishlist_product_ids))
                                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action remove-from-wishlist" data-productid="{{ !empty($value->id)?$value->id:''}}" style="background-color: black;color: white;">
                                                    <span class="icon icon-heart"></span>
                                                    <span class="tooltip">Remove</span>
                                                </a>
                                            @else
                                                <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action add-to-wishlist" data-id="{{ !empty($value->id)?Crypt::encrypt($value->id):''}}" >
                                                    <span class="icon icon-heart"></span>
                                                    <span class="tooltip">Wishlist</span>
                                                </a>
                                            @endif
                            </div>
                            <div class="list-btn-main">
                                @if((!empty($cart_product_ids) && in_array($value->id,$cart_product_ids)) || (empty($tus) && !empty($cart) && $inCart = array_key_exists($value->id, $cart)))
                                <a href="{{url('/')}}/shopping-cart" class="btn-main-product btn btn-primary w-100 go-to-cart" 
                                                data-product-id="{{ !empty($value->id)?$value->id:''}}"
                                                data-product-name="{{ !empty($value->product_name)?$value->product_name:''}}"
                                                data-product-price="{{ !empty($value->offer_price)?$value->offer_price:''}}"
                                                data-product-qty="{{ !empty($value->qty)?$value->qty:1}}"
                                                >Go To cart</a>
                                @else
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product add-to-cart" data-product-id="{{ !empty($value->id)?$value->id:''}}"
                                                data-product-name="{{ !empty($value->product_name)?$value->product_name:''}}"
                                                data-product-price="{{ !empty($value->offer_price)?$value->offer_price:''}}"
                                                data-product-qty="{{ !empty($value->qty)?$value->qty:1}}"
                                                data-product-stock="{{ !empty($value->current_stock)?$value->current_stock:0}}"
                                                
                                                >Add To Cart</a>
                                @endif
                                </div>
                        </div>
                        <div class="card-product-info">
                            <a href="{{ url('product-detail') }}/{{ !empty($value->slug_url)?$value->slug_url:''}}" class="title link">{{ !empty($value->product_name) ? $value->product_name : '' }}</a>
                            <span class="price">${{ !empty($value->offer_price) ? $value->offer_price : '' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
<!-- /Recent product -->

@include ("Front.includes.footer")
<script>
    var base_url = $('#base_url').val();
    $('.rem-from-cart').click(function (e) { 
    var id = $(this).attr('data-id');
    if(id != ''){
        // Add confirmation dialog here
        if(confirm('Are you sure you want to remove this item from the cart?')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: base_url + '/gcart/remove',
                data: {
                    id: id
                },
                dataType: "json",
                beforeSend: function () {
                    $('#content-loader').html('<i class="fa fa-spin fa-spinner"></i>Please Wait...');
                },
                success: function(response) {
                    if(response.status == 'success') {
                        toastr.success(response.message);
                        $('#cartrow_'+response.cartrow_id).remove();
                    } else {
                        toastr.error(response.message);
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 4000);  
                },
            });
        } else {
            // User clicked cancel - do nothing
            return false;
        }
    }      
});


$('.minus-qty, .plus-qty').click(function(e) {
    
        var id=$(this).attr('data-id').split('_')[1];
        
        
        const productId = $('#arcartdiv_'+id).attr('data-product-id');
        let name = $('#arcartdiv_'+id).attr('data-product-name');
        let price = $('#arcartdiv_'+id).attr('data-product-price');
        const input = $('#arcartdiv_'+id).attr('data-product-qty');
        let currentQty = parseFloat(input);

        // Determine new quantity
        if ($(this).hasClass('minus-qty') && currentQty > 1) {
            currentQty--;
        } else if ($(this).hasClass('plus-qty')) {
            currentQty++;
        } else {
            return;
        }

        let max_qty = $(this).attr('data-max');
        if(max_qty==0){
            toastr.error('Product stocked out.');
            $('.product-qty-inp').val('1');
             return false;
        }
        if(currentQty>max_qty){
            toastr.error('You reached at max quantity limit.');
            $('#qty_'+id).val(max_qty);
             return false;
        }
        // Update UI immediately (optimistic)
        
        $('#arcartdiv_'+id).attr('data-product-qty',  currentQty)
        // Make AJAX request
        $.ajax({
             headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url: '{{ route("cart.update.quantity") }}',
            method: 'POST',
            data: {
                name: name,
                price: price,
                product_id: productId,
                quantity: currentQty
            },
             dataType: "json",
            beforeSend: function () {
                        $('#content-loader').html('<i class="fa fa-spin fa-spinner"></i>Please Wait...');
            },
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message);

                } else {
                    toastr.error(response.message);

                }
                setTimeout(function () {
                            location.reload();
                }, 4000);  
            },
            error: function(xhr) {
                toastr.error('An error occurred while updating quantity');
                //alert('An error occurred while updating quantity.');
            }
        });
    });

    $('.process-to-checkout').click(function (e) { 
    var count = $('tr.not_available').length;
    
    if(count>0){
        e.preventDefault();  // Prevent default action
        toastr.error('Some products in cart are not available.');
        return false;
    }
    // Check if the radio button is checked
    if (!$('#check-agree-checkout').is(':checked')) {
        e.preventDefault();  // Prevent default action
        toastr.error('Please agree to proceed to checkout');
        $('#check-agree-checkout').focus();
    }
    
    // Otherwise, the default action will continue
});
</script>