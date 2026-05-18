@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")

        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Forget your password</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="{{ url('') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Forget your password
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->

        <!-- login -->
        <section class="flat-spacing">
            <div class="container">
                <div class="login-wrap">
                    <div class="left">
                        <div class="heading">
                            <h4 class="mb_8">Reset your password</h4>
                            <p>We will send you an email to reset your password</p>
                        </div>
                        <form action="{{url('reset-user-password-action')}}" id="resetPasswordForm" method="post" class="form-login">
                            @csrf
                            <div class="wrap">
                                <fieldset class="">
                                    <input class="" type="email" placeholder="Email Address*" name="email" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="right">
                        <h4 class="mb_8">New Customer</h4>
                        <p class="text-secondary">Be part of our growing family of new customers! Join us today and unlock a world of exclusive benefits, offers, and personalized experiences.</p>
                        <a href="{{ url('register') }}" class="tf-btn btn-fill"><span class="text text-button">Register</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /login -->

        @include ("Front.includes.footer")