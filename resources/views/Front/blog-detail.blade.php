@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")

<style>
    header {
        background-color: #454545e3 !important;
    }
</style>

<!-- blog-detail -->
<div class="blog-detail-wrap">
    <div class="image" style="background-image: url({{!empty($data->blog_image) && Storage::exists($data->blog_image) ? url('/').Storage::url($data->blog_image) : '' }})"></div>
    <div class="inner">
        <div class="heading">
            <!-- <ul class="list-tags has-bg justify-content-center">
                <li>
                    <a href="#" class="link">Lighting Trends</a>
                </li>
            </ul> -->
            <h3 class="fw-5">{{!empty($data->heading)?$data->heading:''}}</h3>
            <div class="meta justify-content-center">
                <div class="meta-item gap-8">
                    <div class="icon">
                        <i class="icon-calendar"></i>
                    </div>
                    <p class="body-text-1">{{!empty($data->date)?date('F d, Y',strtotime($data->date)):''}}</p>
                </div>
                <div class="meta-item gap-8">
                    <div class="icon">
                        <i class="icon-user"></i>
                    </div>
                    <p class="body-text-1">By {{!empty($data->auther)?$data->auther:''}}</p>
                </div>
            </div>
        </div>
        <div class="content">
            <p class="body-text-1 mb_12">
            {!! !empty($data->description)?$data->description:'' !!}
            </p>
           
        </div>
      
        <!-- <div class="content">
            <h3 class="fw-5 mb_16">How to deal with employee quitting</h3>
            <p class="body-text-1 mb_16">Donec eu dui condimentum, laoreet nulla vitae, venenatis ipsum. Donec luctus sem sit amet varius laoreet. Aliquam fermentum sit amet urna fringilla tincidunt. Vestibulum ullamcorper nec lacus ac molestie. Curabitur congue neque sed nisi auctor consequat. Pellentesque rhoncus tortor vitae ipsum sagittis tempor.</p>
            <p class="body-text-1 mb_16">Vestibulum et pharetra arcu. In porta lobortis turpis. Ut faucibus fermentum posuere. Suspendisse potenti. Mauris a metus sed est semper vestibulum. Mauris tortor sem, consectetur vehicula vulputate id, suscipit vel leo.</p>
            <ul class="list-text type-disc mb_16">
                <li class="body-text-1">
                    15+ years of industry experience designing, building, and supporting large-scale distributed systems in production, with recent experience in building large scale cloud services.
                </li>
                <li class="body-text-1">
                    Deep knowledge and experience with different security areas like identity and access management, cryptography, network security, etc.
                </li>
                <li class="body-text-1">
                    Experience with database systems and database internals, such as query engines and optimizers are a big plus.
                </li>
                <li class="body-text-1">
                    Strong fundamentals in computer science skills.
                </li>
                <li class="body-text-1">
                    Expert-level development skills in Java or C++.
                </li>
                <li class="body-text-1">
                    Knowledge of industry standard security concepts and protocols like SAML, SCIM, OAuth, RBAC, cryptography is a plus.
                </li>
                <li class="body-text-1">
                    Advanced degree in Computer Science or related degree.
                </li>
                <li class="body-text-1">
                    Ph.D. in the related field is a plus
                </li>
            </ul>
            <p class="body-text-1 mb_16">Curabitur aliquam ac arcu in mattis. Phasellus pulvinar erat at aliquam hendrerit. Nam ut velit dolor. Sed fermentum tempus odio, ac faucibus elit scelerisque consequat. Fusce ac malesuada elit. Nam at aliquam libero, quis lacinia erat. In hac habitasse platea dictumst. Suspendisse id dolor orci. Vivamus at aliquam tellus. Vestibulum a augue ac purus suscipit varius non eget lectus. Nam lobortis mauris luctus tristique feugiat. Nulla eleifend risus sit amet nisi feugiat, id eleifend sapien malesuada. Phasellus venenatis convallis mattis. Duis vel tempor eros. Mauris semper sollicitudin neque, imperdiet ultrices urna maximus id.
            </p>
        </div> -->
        <div class="bot d-flex justify-content-between gap-10 flex-wrap">
            <ul class="list-tags has-bg">
                <!-- <li>Tag:</li>
                <li>
                    <a href="#" class="link">LCW</a>
                </li>
                <li>
                    <a href="#" class="link">Lighting Trending</a>
                </li> -->
            </ul>
            <div class="d-flex align-items-center justify-content-between gap-16">
                <p>Share this post:</p>
                <ul class="tf-social-icon style-1">
                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                    <li><a target="_blank" href="https://twitter.com/intent/tweet?url={{url()->current()}}&text={{!empty($data->heading)?$data->heading:''}}" class="social-twiter"><i class="icon icon-x"></i></a></li>
                    <li><a target="_blank" href="https://pinterest.com/pin/create/button/?url={{url()->current()}}&media=IMAGE_URL_HERE&description={{!empty($data->heading)?$data->heading:''}}" class="social-pinterest"><i class="icon icon-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- /blog-detail -->

<!-- Related Articles -->
<section class="flat-spacing">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading-section text-center">
                    <h3>Related Articles</h3>
                    <p class="body-text-1">Discover the Hottest Fashion News and Trends Straight from the Runway</p>
                </div>
                <div dir="ltr" class="swiper tf-sw-recent" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        @if(!empty($data->related_blogs))
                        @foreach($data->related_blogs as $k => $value)
                        <div class="swiper-slide">
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{!empty($value->blog_image) && Storage::exists($value->blog_image) ? url('/').Storage::url($value->blog_image) : '' }}" src="{{!empty($data->blog_image) && Storage::exists($data->blog_image) ? url('/').Storage::url($data->blog_image) : '' }}" alt="{{!empty($value->heading)?$value->heading:''}}">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">{{!empty($value->date)?date('F d, Y',strtotime($value->date)):''}}</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">By {{!empty($value->auther)?$value->auther:''}}</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="{{ url('blog-details') }}/{{!empty($value->heading)?$value->slug:''}}">{{!empty($value->heading)?$value->heading:''}}</a>
                                        </h6>
                                        <div class="body-text">
                                                                            {{ !empty($value->description)?substr(strip_tags($value->description),0,150).'...':'' }}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       @endif
                    </div>
                    <div class="sw-pagination-recent sw-dots type-circle d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Related Articles -->


@include ("Front.includes.footer")
<script>
    $(".blogs").addClass("active");
</script>