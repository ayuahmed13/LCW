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
            <h3 class="heading text-center">Terms & Conditions</h3>

                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                   
                    <li>
                    Terms & Conditions
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- Terms of use -->
<section class="flat-spacing">
    <div class="container">
        <div class="terms-of-use-wrap">
            <div class="right">
            {!! !empty($data->content)?$data->content:'' !!}
            </div>
        </div>
    </div>
</section>
<!-- /Terms of use -->

@include ("Front.includes.footer")