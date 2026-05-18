@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keywords) ? $metadata->meta_keywords : '')
@include ("Front.includes.header")
<!-- page-title -->
<div class="page-title" style="background-image: url('{{ asset('front/images/products/new-images/terms-top-banner-image.png') }}'); background-color:#f4f3ee">

    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Blogs</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        <a class="link" href="#">Blogs</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- blog-grid -->
<div class="main-content-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tf-grid-layout md-col-3">
                 @if(!empty($data))
                 @foreach($data as $key =>$value)
                <div class="wg-blog style-1 hover-image">
                        <div class="image">
                            <a class="link" href="{{ url('blog-details') }}/{{!empty($value->heading)?$value->slug:''}}"> <img class="lazyload" data-src="{{ !empty($value->blog_image) && Storage::exists($value->blog_image) ? url('/').Storage::url($value->blog_image) : '' }}" src="{{ !empty($value->blog_image) && Storage::exists($value->blog_image) ? url('/').Storage::url($value->blog_image) : '' }}" alt="{{!empty($value->heading)?$value->heading:''}}"></a>
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
                                    <p class="text-caption-1">By {{!empty($value->auther)?$value->auther:''}}</p>
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
                    @endforeach
                    
                 
                    <ul class="wg-pagination justify-content-center">
                    {{ $data->links() }}
                    </ul>
                    
                </div>
                
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /blog-grid -->


@include ("Front.includes.footer")

<script>
    $(".blogs").addClass("active");
</script>