@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")

<!-- page-title -->
<div class="page-title" style="background-image: url('{{ asset('front/images/products/new-images/terms-top-banner-image.png') }}'); background-color:#f4f3ee">

    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Reseller Pricing Registration</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                   
                    <li>
                        Reseller Pricing Registration
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- contact-us -->
<section class="flat-spacing">
    <div class="container" style="width: 90% !important">
        <div class="contact-us-content">
            <div class="left">
                <h4 class="mb-3">Reseller Registration Page</h4>
                <p class="fw-bold mb-0">**** TAKE NOTE BEFORE APPLYING ****</p>
                <p class="fw-bold mb-0">If you are an end user, ELECTRICIAN, builder, etc; you are NOT classed as a distributor.</p>
                <p>A reseller as a business who STOCKS, PROMOTES and RESELLS our PRODUCTS.  Resellers are required to show a high level of competency as well as a high level of customer support that benefits our brands.</p>
                <p class="fs-6 fw-bold">Complete and send this form to request reseller pricing</p>
                <form id="resellerform" action="{{url('reseller-store')}}" method="post" class="form-leave-comment">
                    @csrf
                    <div class="wrap">
                        <div class="cols">
                            <fieldset class="">
                                <input class="" type="text" placeholder="Your Name*" name="name" id="name" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="">
                                <input class="" type="email" placeholder="Your Email*" name="email" id="email" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                        </div>
                        <div class="cols">
                            <fieldset class="">
                                <input class="" type="text" placeholder="ABN*" name="abn" id="abn" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="">
                                <input class="" type="text" placeholder="Phone Number*" name="mobile" id="mobile" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                        </div>
                        <div class="cols">
                            <fieldset class="">
                                <input class="" type="text" placeholder="Company/Trade Name*" name="company_trade_name" id="company_trade_name" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                        </div>
                        <fieldset class="">
                            <textarea name="message" id="message" rows="4" placeholder="Your Message*" tabindex="2" aria-required="true" required=""></textarea>
                        </fieldset>
                    </div>
                    <div class="button-submit send-wrap">
                        <button class="tf-btn btn-fill" type="submit" id="btn-submit">
                            <span class="text text-button">Send message</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /contact-us -->


@include ("Front.includes.footer")

<script>
    $(document).ready(function () {
        $.validator.addMethod("customEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
            }, "Please enter a valid email address.");

        $("#resellerform").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    customEmail: true
                },
                abn: {
                    required: true,
                    //minlength: 9 // assuming ABN is at least 9 digits
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15
                },
                company_trade_name: {
                    required: true
                },
                message: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Your name must consist of at least 2 characters"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                abn: {
                    required: "Please enter your ABN",
                    minlength: "ABN must be at least 9 digits"
                },
                mobile: {
                    required: "Please enter your phone number",
                    digits: "Please enter only digits",
                    minlength: "Phone number must be at least 10 digits",
                    maxlength: "Phone number can't exceed 15 digits"
                },
                company_trade_name: {
                    required: "Please enter your company/trade name"
                },
                message: {
                    required: "Please enter your message",
                    minlength: "Message must be at least 10 characters"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger');
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
                form.submit(); // Proceed with form submission
            }
        });
    });
</script>
