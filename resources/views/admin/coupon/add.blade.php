@extends('layouts.admin')

@section('title', trans('admin.coupon.add'))

@section('content')
<h3 class="mb-4">@lang('admin.coupon.add')</h3>
@if ($errors->any())
<div class="alert alert-danger mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.CouponDetail.add') }}">
    {{ csrf_field() }}
    <input type="hidden" name="coupon_id" value="{{$coupon->coupon_id}}">
    <div class="form-group">
        <label for="cateName">@lang('admin.coupon.coupon_event')</label>
        <input type="text" class="form-control" id='cateName' name="coupon_event" value="{{$coupon->coupon_event}}" readonly="">
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="parent">@lang('admin.coupon.coupon_type')</label>
            <select class="form-control" name="type" id="parent">
                <option value="">---</option>
                <option value="money" @if($coupon->type == 'money') selected @endif>@lang('admin.coupon.type.money')</option>
                <option value="percent" @if($coupon->type == 'percent') selected @endif>@lang('admin.coupon.type.percent')</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="quantity">@lang('admin.coupon.quantity')</label>
            <input type="number" class="form-control" id="quantity"  name="quantity" min="1">
        </div>
    </div>
    <div class="form-group">
        <label for="coupon_value">@lang('admin.coupon.coupon_value')</label>
        <input type="text" class="form-control" id='coupon_value' name="coupon_value" min="0" value="{{$coupon->coupon_value}}" readonly="">
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="parent">@lang('admin.coupon.start_date')</label>
            <input type="date" class="form-control" name="start_date" value="{{$coupon->start_date}}" readonly="">
        </div>

        <div class="form-group col-md-6">
            <label for="parent">@lang('admin.coupon.end_date')</label>
            <input type="date" class="form-control" name="end_date" value="{{$coupon->end_date}}" readonly="">
        </div>
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary" id="save-btn">@lang('admin.coupon.create')</button>
    </div>
</form>


@endsection