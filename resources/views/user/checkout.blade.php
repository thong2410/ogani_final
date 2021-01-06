@extends('layouts.app') 
@section('title', trans('main.cart.check_out')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('cart') }}">{{ trans('main.cart.list') }}</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('user.cart.order-completed') }}">{{ trans('main.cart.order_completed') }}</a></li>
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
                    <div class="step-block active">
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

      <div class="shop-checkout">
        <div class="container">
          <form action="" method="post" id="cartForm">
            <div class="row">
              <div class="col-12 col-lg-8">
                <div class="d-flex flex-row  justify-content-between">
                  <h2 class="form-title">@lang('main.checkout.billing_details')</h2>
                  <div class="w-25">
                    <select class="select-form w-100" name="saved_address">
                      <option value="default">@lang('main.checkout.saved_address')</option>
                      @foreach($address as $item)
                        <option value="{{ $item->id }}">{{ $item->full_name }} - {{ $item->phone_number }} - {{ $item->order_address2 }} - {{ $item->order_address }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="fullName">@lang('main.checkout.details.fullname') <b class="text-danger">*</b></label>
                    <input class="no-round-input-bg" id="fullName" name="fullName" type="text" required="">
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="phoneNumber">@lang('main.checkout.details.phone_number') <b class="text-danger">*</b></label>
                    <input class="no-round-input-bg" id="phoneNumber" name="phoneNumber" type="tel" required="">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="email">@lang('main.checkout.details.email') <b class="text-danger">*</b></label>
                    <input class="no-round-input-bg" id="email" name="email" type="text" required="">
                    </div>
                </div>
                <div class="form-row" id="address1">
                    <div class="form-group col-md-4">
                    <label for="citites">@lang('main.checkout.details.province_or_city') <b class="text-danger">*</b></label>
                    <select class="select-form no-round-input-bg" id="cities" name="cities" type="text" required="">
                        <option value=""></option>
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}" data-path="{{ $city->name_with_type }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="districts">@lang('main.checkout.details.district') <b class="text-danger">*</b></label>
                    <select class="select-form no-round-input-bg" id="districts" name="districts" type="text" required=""></select>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="wards">@lang('main.checkout.details.commune_or_ward') <b class="text-danger">*</b></label>
                    <select class="select-form no-round-input-bg" id="wards" name="wards" type="text" required=""></select>
                    </div>
                </div>
                <div class="form-group" id="address2">
                  <label for="address">@lang('main.checkout.details.address') <b class="text-danger">*</b></label>
                  <input class="no-round-input-bg" id="address" name="address" type="text" placeholder="@lang('main.checkout.details.address_placeholder')">
                </div>
                <div class="form-group">
                  <input id="saveAddress" name="saveAddress" value="yes" type="checkbox">
                  <label for="saveAddress">@lang('main.checkout.save_address')</label>
                </div>
                <div class="form-group">
                  <label for="note">@lang('main.checkout.order_note')</label>
                  <textarea class="textarea-form-bg" id="note" name="note" name="" cols="30" rows="7"></textarea>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <h2 class="form-title">@lang('main.checkout.your_order')</h2>
                <div class="shopping-cart">
                  <div class="cart-total_block">
                    <table class="table">
                      <colgroup>
                        <col span="1" style="width: 50%">
                        <col span="1" style="width: 50%">
                      </colgroup>
                      <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($list as $index => $item)
                            <tr>
                            <th class="name">{{ $item['name'] }} × <span>{{ $item['quantity'] }}</span></th>
                            <td class="price black" style="border-top: 0">{{ number_format($item['price'] * $item['quantity']) }}₫  @if(!empty($item['unit']))<sub>/ {{ $item['unit'] }}</sub>@endif</td>
                            </tr>
                            @php
                                $total = $total + ($item['price'] * $item['quantity']);
                            @endphp
                        @endforeach
                        <tr class="d-none">
                          <th>SUBTOTAL</th>
                          <td class="price">$169.00</td>
                        </tr>
                        <tr>
                          <th>@lang('main.cart.shipping')</th>
                          <td>
                            <p class="text-success">@lang('main.cart.free_shipping')</p>
                          </td>
                        </tr>
                        <tr>
                          <th>@lang('main.cart.total_price')</th>
                          <td class="total">{{ number_format($total_price) }}₫</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group pl-3">
                    <input type="radio" name="paymethod" id="shipping" value="cod" checked="">
                    <label for="shipping">@lang('main.checkout.paymethod.cash_on_delivery')</label>
                  </div>
                  <button class="place-order normal-btn submit-btn pink" type="submit">@lang('main.checkout.place_order')</button>
                  <div class="alert alert-danger mb-4 print-error-msg mt-4" style="display:none">
                        <ul></ul>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
@endsection
