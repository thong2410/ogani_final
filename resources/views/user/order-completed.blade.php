@extends('layouts.app') 
@section('title', trans('main.cart.list')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('cart') }}">{{ trans('main.cart.list') }}</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('user.cart.checkout') }}">{{ trans('main.cart.order_completed') }}</a></li>
        </ul>
    </div>
</div>
<div class="order-step">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="order-step_block">
                <div class="row no-gutters">
                  <div class="col-12 col-md-4">
                    <div class="step-block">
                      <div class="step">
                        <h2>@lang('main.cart.list')</h2><span>01</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="step-block">
                      <div class="step">
                        <h2>@lang('main.cart.check_out')</h2><span>02</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="step-block active">
                      <div class="step">
                        <h2>@lang('main.cart.order_completed')</h2><span>03</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="order-complete">
        <div class="container">
          <div class="row">
            <div class="col-12 justify-content-center align-items-center text-center">
              <h1>@lang('main.checkout.congratulation')</h1>
            </div>
            <div class="col-12">
              <div class="benefit-block">
                <div class="our-benefits shadowless benefit-border">
                  <div class="row no-gutters">
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="/assets/images/homepage02/benefit-icon1.png" alt="">
                      <h5 class="benefit-title">@lang('main.benefit.free_ship')</h5>
                      <p class="benefit-describle">@lang('main.benefit.free_ship_desc')</p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="/assets/images/homepage02/benefit-icon2.png" alt="">
                      <h5 class="benefit-title">@lang('main.benefit.delivery_on_time')</h5>
                       <p class="benefit-describle">@lang('main.benefit.delivery_on_time_desc')</p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="/assets/images/homepage02/benefit-icon3.png" alt="">
                      <h5 class="benefit-title">@lang('main.benefit.secure_payment')</h5>
                       <p class="benefit-describle">@lang('main.benefit.secure_payment_desc')</p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail boderless boderless d-flex flex-column align-items-center"><img class="benefit-img" src="/assets/images/homepage02/benefit-icon4.png" alt="">
                        <h5 class="benefit-title">@lang('main.benefit.support')</h5>
                        <p class="benefit-describle">@lang('main.benefit.support_desc')</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
