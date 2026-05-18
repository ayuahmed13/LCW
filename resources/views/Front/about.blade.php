@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")
<style>
    .testimonial-item.style-4 {
        min-height: 386px;
    }
</style>

<!-- page-title -->
<div class="page-title" style="background-image: url(images/section/page-title.jpg);">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">About Us</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('') }}">Home</a>
                    </li>

 
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        About Us
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- about-us -->
<section class="flat-spacing about-us-main pb_0">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-us-features wow fadeInLeft">
                    <img class="lazyload" data-src="{{ !empty($about_us_cms->image) && Storage::exists($about_us_cms->image) ? url('/').Storage::url($about_us_cms->image) : '' }}" src="{{ !empty($about_us_cms->image) && Storage::exists($about_us_cms->image) ? url('/').Storage::url($about_us_cms->image) : '' }}" alt="image-team">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-us-content">
                    <h3 class="title wow fadeInUp">{{!empty($about_us_cms->heading)?$about_us_cms->heading:''}}</h3>
                    <div class="widget-tabs style-3">
                        <ul class="widget-menu-tab wow fadeInUp">
                            <li class="item-title active">
                                <span class="inner text-button">About LCW</span>
                            </li>
                            <li class="item-title">
                                <span class="inner text-button">Our Vision & Mission</span>
                            </li>

                        </ul>
                        <div class="widget-content-tab wow fadeInUp">
                            <div class="widget-content-inner active">
                                <p>{{!empty($about_us_cms->about_lcw)?$about_us_cms->about_lcw:''}}</p>
                            </div>
                            <div class="widget-content-inner">
                                <p>{{!empty($about_us_cms->our_vision)?$about_us_cms->our_vision:''}}</p>

                                <p>{{!empty($about_us_cms->our_mission)?$about_us_cms->our_mission:''}}</p>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /about-us -->

<!-- Iconbox -->
<section class="flat-spacing line-bottom-container">
    <div class="container">
        <div dir="ltr" class="swiper tf-sw-iconbox" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
            <div class="swiper-wrapper">
                @if($homeCms->section5_heading1)
                <div class="swiper-slide">
                    <div class="tf-icon-box style-2">
                        <img src="{{ !empty($homeCms->section5_icon1)? url('/') . Storage::url($homeCms->section5_icon1):'' }}" height="100px" width="100px">

                        <div class="content">
                            <h6>{{$homeCms->section5_heading1}}</h6>
                            <p class="text-secondary">{{$homeCms->section5_sub_heading1}}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($homeCms->section5_heading2)
                <div class="swiper-slide">
                    <div class="tf-icon-box style-2">
                        <img src="{{ !empty($homeCms->section5_icon2)? url('/') . Storage::url($homeCms->section5_icon2):'' }}" height="100px" width="100px">

                        <div class="content">
                            <h6>{{$homeCms->section5_heading2}}</h6>
                            <p class="text-secondary">{{$homeCms->section5_sub_heading2}}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($homeCms->section5_heading3)
                <div class="swiper-slide">
                    <div class="tf-icon-box style-2">
                        <img src="{{ !empty($homeCms->section5_icon3)? url('/') . Storage::url($homeCms->section5_icon3):'' }}" height="100px" width="100px">

                        <div class="content">
                            <h6>{{$homeCms->section5_heading3}}</h6>
                            <p class="text-secondary">{{$homeCms->section5_sub_heading3}}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($homeCms->section5_heading4)
                <div class="swiper-slide">
                    <div class="tf-icon-box style-2">
                        <img src="{{ !empty($homeCms->section5_icon4)? url('/') . Storage::url($homeCms->section5_icon4):'' }}" height="100px" width="100px">

                        <div class="content">
                            <h6>{{$homeCms->section5_heading4}}</h6>
                            <p class="text-secondary">{{$homeCms->section5_sub_heading4}}</p>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <div class="sw-pagination-iconbox sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
<!-- /Iconbox -->



<!-- Partner -->
<section class="flat-spacing-5 bg-surface" style="display:none;">
    <div dir="ltr" class="swiper tf-sw-partner sw-auto" data-preview="auto" data-tablet="auto" data-mobile-sm="auto" data-mobile="auto" data-space-lg="74" data-space-md="50" data-space="50" data-loop="true" data-auto-play="true" data-delay="0">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/vanfaba.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/anvouge.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/carolin.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/shangxi.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/ecomife.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/cheryl.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/sopify.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/pennyw.png" alt="brand">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="brand-item">
                    <img src="images/brand/panadoxn.png" alt="brand">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- /Partner -->

<!-- Testimonial -->
@if(!empty($testimonials))
<section class="flat-spacing">
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h3 class="heading">Testimonials</h3>
        </div>
        <div dir="ltr" class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay="0.1s" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
            <div class="swiper-wrapper">
                @foreach($testimonials as $k => $value)
                <div class="swiper-slide">
                    <div class="testimonial-item style-4">
                        <div class="content-top">
                            <div class="box-icon">
                                <i class="icon icon-quote"></i>
                            </div>
                            <div class="text-title">{{!empty($value->heading)?$value->heading:''}}</div>
                            <p class="text-secondary">{!! !empty($value->description) ? $value->description : '' !!} </p>
                            <div class="box-rate-author">
                                <div class="box-author">
                                    <div class="text-title author">{{!empty($value->name)?$value->name:''}}</div>
                                </div>
                                <div class="list-star-default color-primary">
                                    @if(!empty($value->star_rating))
                                    @for($i = 0; $i < $value->star_rating; $i++)
                                    <i class="icon icon-star"></i>
                                    @endfor
                                    <!-- <i class="icon icon-star"></i>
                                    <i class="icon icon-star"></i>
                                    <i class="icon icon-star"></i>
                                    <i class="icon icon-star"></i> -->
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center"></div>
        </div>
    </div>
</section>
@endif
<!-- /Testimonial -->

@include ("Front.includes.footer")

<script>
    $(".about").addClass("active");
</script>