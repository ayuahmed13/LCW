@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")


<!-- map -->
<div class="wrap-map">
    <!-- <div id="map-contact" class="map-contact h520" data-map-zoom="16" data-map-scroll="true"></div> -->
    <iframe src="{{!empty($data->map_link)?$data->map_link:''}}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13221.246830696122!2d150.7516908741953!3d-34.06152291051257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12e55889346653%3A0x33f312e5da77e0f2!2sWQR6%2B27W%2C%20Mount%20Annan%20NSW%202567%2C%20Australia!5e0!3m2!1sen!2sin!4v1744694135512!5m2!1sen!2sin -->
</div>
<!-- /map -->

<!-- contact-us -->
<section class="flat-spacing">
    <div class="container">
        <div class="contact-us-content">
            <div class="left">
                <h4>{{!empty($data->heading)?$data->heading:''}}</h4>
                <p class="text-secondary-2">{{!empty($data->description)?$data->description:''}}</p>
                <form id="contactformA" action="{{url('contact-store')}}" method="post" class="form-leave-comment">
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
                                <input class="" type="text" placeholder="Mobile No*" name="mobile" id="mobile" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="">
                                <input class="" type="text" placeholder="Subject*" name="subject" id="subject" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                        </div>
                        <fieldset class="">
                            <textarea name="message" id="message" rows="4" placeholder="Your Message*" tabindex="2" aria-required="true" required=""></textarea>
                        </fieldset>
                        @if(1==32)
                        <div class="cols no-select" style="width: fit-content;">
                        <fieldset class="no-select" style="color:lightgray;background:gray;font-size:35px;text-align:center;padding:10px">
                            <strong class="no-select">{{ $captcha }}</strong>  
                        </fieldset>
                        <fieldset class="no-select">
                            <input class="no-select" type="text" placeholder="Please Enter Captcha*" name="captcha" id="captcha"  aria-required="true" required="">
                            </fieldset>
                        </div>
                        @endif
                    </div>
                    <div class="button-submit send-wrap">
                        <button class="tf-btn btn-fill" type="submit" id="btn-submit">
                            <span class="text text-button">Send message</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="right">
                <h4>Information</h4>
                <div class="mb_20">
                    <div class="text-title mb_8">Phone:</div>
                    <a href="callto:+61 469 302 231"><p class="text-secondary">{{!empty($data->mobile)?$data->mobile:''}}</p></a>
                </div>
                <div class="mb_20">
                    <div class="text-title mb_8">Email:</div>
                    <a href="mailto:{{!empty($data->email)?$data->email:''}}"><p class="text-secondary">{{!empty($data->email)?$data->email:''}}</p></a>
                </div>
                <div class="mb_20">
                    <div class="text-title mb_8">Address:</div>
                    <p class="text-secondary">{{!empty($data->address)?$data->address:''}}</p>
                </div>
                <div>
                    <div class="text-title mb_8">Open Time:</div>
                    <p class="mb_4 open-time" >
                        <span style="width: 100%;" class="text-secondary">{{!empty($data->opening_hours)?$data->opening_hours:''}}
                    </p>
                    <!-- <p class="open-time">
                        <span class="text-secondary">Sunday:</span> 9:00am - 5:00pm PST
                    </p> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /contact-us -->


@include ("Front.includes.footer")

<script>
    $(".contact").addClass("active");
</script>
<script>
$(document).ready(function () {
    $("#contactformA").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            subject: {
                required: true,
                minlength: 3
            },
            message: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 2 characters"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email"
            },
            mobile: {
                required: "Please enter your mobile number",
                digits: "Only digits are allowed",
                minlength: "Mobile number must be at least 10 digits",
                maxlength: "Mobile number cannot exceed 15 digits"
            },
            subject: {
                required: "Please enter a subject",
                minlength: "Subject must be at least 3 characters"
            },
            message: {
                required: "Please enter your message",
                minlength: "Message must be at least 10 characters"
            }
        },
        errorElement: "div",
        submitHandler: function (form) {
            // Optional: Disable the button to prevent double submit
            $('#btn-submit').prop('disabled', true).text('Please wait...');
            form.submit();
        }
    });
});

$(document).ready(function() {
    $('#captcha')
      .on('cut copy paste', function(e) {
        e.preventDefault();
      })
      .on('selectstart', function(e) {
        e.preventDefault();
      });

    $('.no-select').on('selectstart', function (e) {
        e.preventDefault();
    });
  });
</script>
