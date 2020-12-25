@extends('layouts.app') 
@section('title', trans('main.user_profile.my_orders')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('user.index') }}">@lang('main.my_account')</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('user.wishlist') }}">{{ trans('main.user_profile.my_orders') }}</a></li>
        </ul>
    </div>
</div>
<div class="shopping-cart">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-responsive table-bordered"> 
                  <colgroup>
                    <col span="1" style="width: @if(count($orders) > 0) 15% @else 30% @endif">
                    <col span="1" style="width: 30%">
                    <col span="1" style="width: 20%">
                    <col span="1" style="width: 20%">
                    <col span="1" style="width: 10%">
                  </colgroup>
                  <thead>
                    <tr>
                      <th class="product-iamge" scope="col">#</th>
                      <th class="product-name" scope="col">@lang('main.order.fullname')</th>
                      <th class="product-price" scope="col">@lang('main.order.phone')</th>
                      <th class="product-total" scope="col">@lang('main.order.email')</th>
                      <th class="product-clear" scope="col">@lang('main.order.status')</th>
                      <th class="product-clear" scope="col">@lang('main.order.created')</th>
                      <th class="product-clear" scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($orders) > 0)
                    @foreach($orders as $order)
                    <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->full_name }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ $order->order_email }}</td>
                    <td>{!! trans('admin.order.status_label.'.$order->order_status) !!}</td>
                    <td><span class="badge">{{ $order->created_at }}</span></td>
                    <td>
                        <a href="#" rel="{{ route('user.order.detail', $order->order_id) }}" class="load-modal">
                         <button type="button" class="btn btn-sm btn-outline-dark mr-1 mb-1"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        </a>                 
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
            {{ $orders->links('vendor.pagination.shop') }}
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('shop') }}" class="normal-btn black cart-update">@lang('main.wishlist.continue_shopping')</a>
            </div>
          </div>
        </div>
      </div>
@endsection
