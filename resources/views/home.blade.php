@extends('layouts.app') 
@section('title', trans('main.home')) 
@section('content')
@include('subviews.banner')

<div class="home3-product-block"> 
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-3">
                <div class="deal-of-week_slide">
                    <div class="week-deal_top mini-tab-title underline pink">
                        <h2 class="title">@lang('main.best_deal')</h2>
                        <div class="week-deal_control"></div>
                    </div>
                    <div class="week-deal_bottom">
                        @foreach($deals as $deal)
                            @include('subviews.items.deal-block', $deal)
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-benefit">
                    <div class="benefit-block">
                        <div class="our-benefits column shadowless benefit-border">
                            <div class="row">
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="benefit-detail d-flex flex-row align-items-center"><img class="benefit-img" src="assets/images/homepage02/benefit-icon1.png" alt="">
                                        <div class="benefit-detail_info">
                                            <h5 class="benefit-title">@lang('main.benefit.free_ship')</h5>
                                            <p class="benefit-describle">@lang('main.benefit.free_ship_desc')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="benefit-detail d-flex flex-row align-items-center"><img class="benefit-img" src="assets/images/homepage02/benefit-icon2.png" alt="">
                                        <div class="benefit-detail_info">
                                            <h5 class="benefit-title">@lang('main.benefit.delivery_on_time')</h5>
                                            <p class="benefit-describle">@lang('main.benefit.delivery_on_time_desc')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="benefit-detail d-flex flex-row align-items-center"><img class="benefit-img" src="assets/images/homepage02/benefit-icon3.png" alt="">
                                        <div class="benefit-detail_info">
                                            <h5 class="benefit-title">@lang('main.benefit.secure_payment')</h5>
                                            <p class="benefit-describle">@lang('main.benefit.secure_payment_desc')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="benefit-detail boderless d-flex flex-row align-items-center"><img class="benefit-img" src="assets/images/homepage02/benefit-icon4.png" alt="">
                                        <div class="benefit-detail_info">
                                            <h5 class="benefit-title">@lang('main.benefit.support')</h5>
                                            <p class="benefit-describle">@lang('main.benefit.support_desc')</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sale-product">
                    <div class="sale-product_top mini-tab-title underline pink">
                        <h2 class="title">@lang('main.sale_products')</h2>
                    </div>
                    <div class="sale-product_bottom">
                        <div class="row">
                            @foreach($sales as $prod)
                                @include('subviews.items.sale-product', $prod)
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="customer-satisfied text-center">
                    <div class="customer-satisfied_border">
                        <div class="customer-satisfied_wrapper">
                            @foreach($reviews as $review)
                                @include('subviews.items.reviews-block', $review)
                            @endforeach
                        </div>
                        <div class="customer-satisfied_control"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-9" >
                <div id="tab">
                    <div class="best-seller_top mini-tab-title underline pink">
                        <div class="row align-items-md-center">
                            <div class="col-12 col-md-4">
                                <h2 class="title">@lang('main.feature_product')</h2>
                            </div>
                            <div class="col-12 col-md-8 text-lg-right">
                            </div>
                        </div>
                    </div>
                    <div class="best-seller_bottom">
                        <div id="tab1">
                            <div class="row no-gutters-sm">
                                @foreach ($featured as $prod) 
                                <div class="col-6 col-md-4">
                                    @include('subviews.items.block-product', $prod)
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="quick-banner">
                    <div class="row justify-content-center align-items-center flex-column flex-md-row">
                        <div class="col-12 col-md-5">
                            <div class="bannner-img text-center"><img class="img-fluid" src="assets/images/homepage03/quick_banner_1_img.png" alt=""></div>
                        </div>
                        <div class="col-10 col-md-5">
                            <div class="banner-text text-center text-md-left">
                                <div class="mb-2 discount-block d-flex align-items-center justify-content-center justify-content-md-start text-left">
                                    <h2 class="big-number">50%</h2>
                                    <h3>OFF<br>Black <span>Friday</span></h3>
                                </div>
                                <p>@lang('main.slogan_sale') </p><a class="normal-btn pink" href="{{ route('shop') }}">@lang('main.shop_now')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-so1">
                    <div class="best-seller_top mini-tab-title underline pink">
                        <div class="row align-items-md-center">
                            <div class="col-12 col-md-4">
                                <h2 class="title">@lang('main.best_seller')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="best-seller_bottom">
                        <div id="tab5">
                            <div class="row no-gutters-sm">
                                @foreach ($best_seller as $prod) 
                                <div class="col-6 col-md-4">
                                    @include('subviews.items.block-product', $prod)
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-so2">
                    <div class="best-seller_top mini-tab-title underline pink">
                        <div class="row align-items-md-center">
                            <div class="col-12 col-md-4">
                                <h2 class="title">@lang('main.lastest_products')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="best-seller_bottom">
                        <div id="tab5">
                            <div class="row no-gutters-sm">
                                @foreach ($products as $prod) 
                                <div class="col-6 col-md-4">
                                    @include('subviews.items.block-product', $prod)
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- End product block-->
@endsection