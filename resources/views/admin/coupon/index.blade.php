@extends('layouts.admin')

@section('title', trans('admin.coupon.categories'))

@section('content')
<h3 class="mb-4">@lang('admin.coupon.categories')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="{{route('admin.coupon.index')}}" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.coupon.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-4 col-xs-12 mb-2">
        <select class="form-control" name="type" id="role">
                    <option value="">---</option>
                    <option value="money" {{ isset($input['type']) && $input['type'] == 'money' ? 'selected' : '' }}>@lang('admin.coupon.type.money')</option>
                    <option value="percent" {{ isset($input['type']) && $input['type'] == 'percent' ? 'selected' : '' }}>@lang('admin.coupon.type.percent')</option>
        </select>
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        @if(isset($input['type']) || isset($input['keyword']))<a href="{{route('admin.coupon.index')}}"><button class="btn btn-info" type="button"><i class="fas fa-reply-all"></i></button></a>@endif
    </div>
  </div>
</form>
<hr/>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">@lang('admin.coupon.coupon_event')</th>
                <th scope="col">@lang('admin.coupon.coupon_type')</th>
                <th scope="col">@lang('admin.coupon.coupon_value')</th>
                <th scope="col">@lang('admin.coupon.start_date')</th>
                <th scope="col">@lang('admin.coupon.end_date')</th>
                <th scope="col">@lang('admin.coupon.quantity')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($coupons) > 0)
            @foreach ($coupons as $coupon)
            <tr>
                <td><a href="#"><b>{{ $coupon->coupon_event }}</b></a></td>
                <td><span class=" badge @if($coupon->type == 'money') badge-info @else badge-success @endif"> @lang('admin.coupon.type.'.$coupon->type) </span></td>
                <td>{{ number_format($coupon->coupon_value) }}</td>
                <td>{{ $coupon->start_date }}</td>
                <td>{{ $coupon->end_date }}</td>
                <td>@php 
                    echo count($coupon->coupon_detail); 
                    @endphp
                </td>
                <td>
                    <form action="{{ route('admin.coupon.destroy', $coupon->coupon_id) }}" method="POST"
                        class="form-inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-sm btn-outline-danger mr-1"><i class="fa fa-trash"
                                aria-hidden="true"></i></button>
                        <a href="{{ route('admin.CouponDetail.show', $coupon->coupon_id) }}" class="mr-1">
                            <button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-pen"
                                    aria-hidden="true"></i></button>
                        </a>
                        <a href="{{ route('admin.CouponDetail.getadd', $coupon->coupon_id) }}">
                            <button type="button" class="btn btn-sm btn-outline-success"><i class="fas fa-plus" ></i></button>
                        </a>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3" class="text-center">@lang('admin.coupon.not_found')</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{{ $coupons->appends($input)->links() }}

@endsection