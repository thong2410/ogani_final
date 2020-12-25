@extends('layouts.app') 
@section('title', trans('main.wishlist.list')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('user.index') }}">@lang('main.my_account')</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('user.wishlist') }}">{{ trans('main.wishlist.list') }}</a></li>
        </ul>
    </div>
</div>
<div class="shopping-cart">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="product-table">
                <table class="table table-responsive"> 
                  <colgroup>
                    <col span="1" style="width: @if(count($list) > 0) 15% @else 30% @endif">
                    <col span="1" style="width: 30%">
                    <col span="1" style="width: 20%">
                    <col span="1" style="width: 20%">
                    <col span="1" style="width: 10%">
                  </colgroup>
                  <thead>
                    <tr>
                      <th class="product-iamge" scope="col">@lang('main.wishlist.image')</th>
                      <th class="product-name" scope="col">@lang('main.wishlist.product_name')</th>
                      <th class="product-price" scope="col">@lang('main.wishlist.unit_price')</th>
                      <th class="product-total" scope="col">@lang('main.wishlist.total_price')</th>
                      <th class="product-clear" scope="col"> 
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($list) > 0)
                    @foreach($list as $item)
                    <tr>
                      <td class="product-iamge"> 
                        <div class="img-wrapper"><img src="/{{ $item->product->thumb->path }}/{{ $item->product->thumb->name }}" alt="product image"></div>
                      </td>
                      <td class="product-name"><a href="{{ route('product.detail', $item->product_id) }}" target="_blank">{{ $item->product->prod_name }}</a></td>
                      <td class="product-price">{{ number_format($item->product->unit_price - $item->product->unit_price * ($item->product->sale / 100)) }}₫ @if(!empty($item->product->unit))<sub>/ {{ $item->product->unit }}</sub>@endif</td>
                    
                      <td class="product-total">{{ number_format(($item->product->unit_price - $item->product->unit_price * ($item->product->sale / 100)) * $item->quantity) }}₫</td>
                      <td class="product-clear"> 
                      <button class="remove-wish-product no-round-btn" data-id="{{ $item->product_id }}"><i class="fas fa-times"></i></button>
                      <button class="add-to-cart no-round-btn" data-id="{{ $item->product_id }}"><i class="fas fa-cart-plus"></i></button>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-center">
                        <td colspan="5">{{ trans('main.wishlist.no_result') }}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-6 text-left">
            {{ $list->links('vendor.pagination.shop') }}
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('shop') }}" class="normal-btn black cart-update">@lang('main.wishlist.continue_shopping')</a>
            </div>
          </div>
        </div>
      </div>
@endsection
