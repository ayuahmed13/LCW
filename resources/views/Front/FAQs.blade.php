@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")

        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/section/page-title.jpg); background-color:#f4f3ee">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">FAQ's</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="{{ url('') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                <a class="link" href="#">Pages</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                FAQ's
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->

        <!-- FAQs -->
        <section class="flat-spacing">
            <div class="container">
                <div class="page-faqs-wrap">
                    <div class="list-faqs">
                        <div>
                            <h5 class="faqs-title">FAQ's</h5>
                            <ul class="accordion-product-wrap style-faqs" id="accordion-faq-1">
                                @if(!empty($data))
                                @foreach($data as $k =>$value)
                                <li class="accordion-product-item" >
                                    <a href="#accordion-{{$k}}" class="accordion-title collapsed current \" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-{{$k}}">
                                        <h6>{{!empty($value->question)?$value->question:''}}</h6>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="accordion-{{$k}}" class="collapse {{empty($k)?'show':''}}" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">{!! !empty($value->answer)?$value->answer:'' !!}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                               @endif
                            </ul>
                        </div>
                        <div>
                            <ul class="accordion-product-wrap style-faqs" id="accordion-faq-2">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /FAQs -->

        @include ("Front.includes.footer")