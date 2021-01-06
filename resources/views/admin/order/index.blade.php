
@extends('layouts.admin')

@section('title', $title)

@section('content')
<h3 class="mb-4">{{ $title }}</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.order.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-4 col-xs-12 mb-2">
        <select class="form-control" name="status" id="status">
                    <option value="">---</option>
                    <option value="processing" {{ isset($input['status']) && $input['status'] == 'processing' ? 'selected' : '' }}>@lang('admin.order.status_str.processing')</option>
                    <option value="shipping" {{ isset($input['status']) && $input['status'] == 'shipping' ? 'selected' : '' }}>@lang('admin.order.status_str.shipping')</option>
                    <option value="delivered" {{ isset($input['status']) && $input['status'] == 'delivered' ? 'selected' : '' }}>@lang('admin.order.status_str.delivered')</option>
                    <option value="cancelled" {{ isset($input['status']) && $input['status'] == 'cancelled' ? 'selected' : '' }}>@lang('admin.order.status_str.cancelled')</option>
        </select>
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        @if(isset($input['status']) || isset($input['keyword']))<a href="{{route('admin.order.index')}}"><button class="btn btn-info" type="button"><i class="fas fa-reply-all"></i></button></a>@endif
    </div>
  </div>
</form>
<hr/>
<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('admin.order.username')</th>
                <th scope="col">@lang('admin.order.fullname')</th>
                <th scope="col">@lang('admin.order.phone')</th>
                <th scope="col">@lang('admin.order.email')</th>
                <th scope="col">@lang('admin.order.status')</th>
                <th scope="col">@lang('admin.order.date')</th>
                <th scope="col">@lang('admin.coupon.coupon')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($orders) > 0)
                @foreach ($orders as $order)
                <tr>
                <td>{{ $order->order_id }}</td>
                <td><b>{{ $order->user->username }}</b></td>
                <td>{{ $order->full_name }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->order_email }}</td>
                <td>{!! trans('admin.order.status_label.'.$order->order_status) !!}</td>
                <td><span class="badge">{{ $order->created_at }}</span></td>
                <td>
                    @php
                        $coupons = explode(',',$order->coupon);
                        foreach($coupons as $coupon){
                            if($coupon < 100 && $coupon > 0 ){
                                echo $coupon.'% <br>';
                            }elseif($coupon != null){
                               echo $coupon.'VNĐ <br>';
                            }  
                        }
                    @endphp
                </td>
                <td>
                        <form action="{{ route('admin.order.destroy', $order->order_id) }}" method="POST"
                            class="form-inline">
                            <a href="#" rel="{{ route('admin.order.show', $order->order_id) }}" class="load-modal">
                                <button type="button" class="btn btn-sm btn-outline-success mr-1 mb-1"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </a>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>                   
                </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center">@lang('admin.order.not_found')</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
{{ $orders->appends($input)->links() }}


@endsection