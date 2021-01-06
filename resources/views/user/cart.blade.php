@extends('layouts.app') 
@section('title', trans('main.cart.list')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link active" href="{{ route('cart') }}">{{ trans('main.cart.list') }}</a></li>
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
                    <div class="step-block active">
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
                    <div class="step-block">
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
    <div class="shopping-cart">
        <form id="cartForm">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="product-table">
                <table class="table table-responsive"> 
                  <colgroup>
                    <col span="1" style="width: @if(count($list) > 0) 15% @else 25% @endif">
                    <col span="1" style="width: 30%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 15%">
                  </colgroup>
                  <thead>
                    <tr>
                      <th class="product-iamge" scope="col">@lang('main.cart.image')</th>
                      <th class="product-name" scope="col">@lang('main.cart.product_name')</th>
                      <th class="product-price" scope="col">@lang('main.cart.unit_price')</th>
                      <th class="product-quantity" scope="col">@lang('main.cart.quantity')</th>
                      <th class="product-total" scope="col">@lang('main.cart.total_price')</th>
                      <th class="product-clear" scope="col"> 
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($list) && count($list) > 0)
                    @foreach($list as $index => $item)
                    <tr>
                      <td class="product-iamge"> 
                        <div class="img-wrapper"><img src="{{ $item['photo'] }}" alt="product image"></div>
                      </td>
                      <td class="product-name"><a href="{{ route('product.detail', $index) }}" target="_blank">{{ $item['name'] }}</a></td>
                      <td class="product-price">{{ number_format($item['price']) }}₫ @if(!empty($item['unit']))<sub>/ {{ $item['unit'] }}</sub>@endif</td>
                      <td class="product-quantity">
                        <input type="hidden" value="{{ $index }}" name="c_id[]">
                        <input class="quantity no-round-input" type="number" name="quantity[]" min="1" value="{{ $item['quantity'] }}">
                      </td>
                      <td class="product-total">{{ number_format($item['price'] * $item['quantity']) }}₫</td>
                      <td class="product-clear"> 
                      <button class="cart-remove-item no-round-btn" data-id="{{ $index }}" type="button"><i class="fas fa-times"></i></button>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-center">
                        <td colspan="5">{{ trans('main.cart.no_result') }}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-12 text-right">
              <button type="button" class="update-cart normal-btn black cart-update">@lang('main.cart.update')</button>
            </div>
          </div>
        </form>
          @if(isset($list) && count($list) > 0)
          <div class="row justify-content-end">
            <div class="col-12 col-md-6 col-lg-8">
              <div class="cart-total_block">
                <h2>@lang('admin.coupon.coupon')</h2>
                <table class="table">
                  <colgroup>
                    <col span="1" style="width: 80%">
                    <col span="1" style="width: 20%">
                  </colgroup>
                  <tbody>
                    <tr>
                      <form action="" method="">
                        {{ csrf_field() }}
                        <td><input type="text" id="code" class="form-control" name="code" placeholder="@lang('main.cart.placeholder_coupon')"></td>
                        <td><button class="btn btn-danger" id="checkcoupon">Submit</button></td>
                      </form>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>


            <div class="col-12 col-md-6 col-lg-4">
              <div class="cart-total_block">
                <h2>@lang('main.cart.cart_total')</h2>
                <table class="table">
                  <colgroup>
                    <col span="1" style="width: 50%">
                    <col span="1" style="width: 50%">
                  </colgroup>
                  <tbody>
                    <tr class="d-none">
                      <th>SUBTOTAL</th>
                      <td>  
                      </td>
                    </tr>
                    <tr>
                      <th>@lang('main.cart.shipping')</th>
                      <td>
                        <p class="text-success">@lang('main.cart.free_shipping')</p>
                      </td>
                    </tr>
                    <tr>
                      <th>@lang('main.cart.total_price')</th>
                      <td>
                            {{ number_format($total_price) }} ₫
                        </td>
                    </tr>
                  </tbody>
                </table>
                <div class="checkout-method">
                  <a href="{{ route('user.cart.checkout') }}" class="d-block"><button type="button" class="normal-btn pink">@lang('main.cart.proceed_to_checkout')</button></a>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
@endsection
