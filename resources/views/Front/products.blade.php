@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ('Front.includes.header')
<style>
    .truncate-text {
        display: inline-block;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }
</style>
<!-- page-title -->
<div class="page-title" style="background-image: url(images/section/page-title.jpg); background-color:#f4f3ee">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Products</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        Products
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->
<!-- Collections -->
<section class="flat-spacing">
    <div class="container">
        <div class="tf-grid-layout tf-col-2 lg-col-4">
            <!-- item 1 -->
            @if (!empty($categories_list))
                @foreach ($categories_list as $k => $value)
                    <div class="collection-position-2 radius-lg style-3 hover-img">
                        <a href="{{ url('product-categories') }}/{{ !empty($value->slug) ? $value->slug : '' }}"
                            class="img-style">
                            <img class="lazyload"
                                data-src="{{ !empty($value->category_image) && Storage::exists($value->category_image) ? url('/') . Storage::url($value->category_image) : URL::asset('front/images/default-img.jpg') }}"
                                src="{{ !empty($value->category_image) && Storage::exists($value->category_image) ? url('/') . Storage::url($value->category_image) : URL::asset('front/images/default-img.jpg') }}"
                                alt="banner-cls">
                        </a>
                        <div class="content">
                            <a href="{{ url('product-categories/' . ($value->slug ?? '')) }}" class="cls-btn">
                                <h6 class="text truncate-text">
                                    {{ \Illuminate\Support\Str::limit($value->category_name ?? '', 18) }}
                                </h6>
                                <span class="count-item text-secondary">
                                    {{ $value->product_count ?? '0' }}
                                </span>
                                <i class="icon icon-arrowUpRight"></i>
                            </a>

                        </div>
                    </div>
                @endforeach
            @endif
            <!-- pagination -->
            <!-- <ul class="wg-pagination justify-content-center">
                        <li><a  class="pagination-item text-button">1</a></li>
                        <li class="active"><div class="pagination-item text-button">2</div></li>
                        <li><a class="pagination-item text-button">3</a></li>
                        <li><a  class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
                    </ul> -->

            <div class="pagination-wrapper">
                {{ $categories_list->links() }}
            </div>
        </div>
    </div>
</section>
<!-- /Collections -->




@include ('Front.includes.footer')

<script>
    $(".product").addClass("active");
</script>
