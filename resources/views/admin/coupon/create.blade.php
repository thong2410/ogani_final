@extends('layouts.admin')

@section('title', trans('admin.coupon.create'))

@section('content')
<h3 class="mb-4">@lang('admin.coupon.create')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.coupon.store') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="cateName">@lang('admin.coupon.coupon_event')</label>
        <input type="text" class="form-control" id='cateName' name="coupon_event">
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="parent">@lang('admin.coupon.coupon_type')</label>
            <select class="form-control" name="type" id="parent">
                <option value="">---</option>
                <option value="money" >@lang('admin.coupon.type.money')</option>
                <option value="percent" >@lang('admin.coupon.type.percent')</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="quantity">@lang('admin.coupon.quantity')</label>
            <input type="number" class="form-control" id="quantity"  name="quantity" min="1">
        </div>
    </div>
    <div class="form-group" id="money" style="display: none;">
        <label for="coupon_value">@lang('admin.coupon.coupon_value')</label>
        <div class="input-group mb-3">
            <span class="input-group-text">VNĐ</span>
            <input type="number" class="form-control" id='coupon_value' name="coupon_value" min="1000" aria-label="Amount (to the nearest dollar)" placeholder="@lang('admin.coupon.placeholder.money')" required="">
            <span class="input-group-text">.00</span>
        </div>
    </div>
    <div class="form-group" id="percent" style="display: none;">
        <label for="coupon_value">@lang('admin.coupon.coupon_value')</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Percent</span>
            <input type="number" class="form-control" id='coupon_value' name="coupon_value" min="0" aria-label="Amount (to the nearest dollar)" placeholder="@lang('admin.coupon.placeholder.percent')" max="100" required="">
            <span class="input-group-text">%</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="parent">@lang('admin.coupon.start_date')</label>
            <input type="date" class="form-control" name="start_date">
        </div>

        <div class="form-group col-md-6">
            <label for="parent">@lang('admin.coupon.end_date')</label>
            <input type="date" class="form-control" name="end_date">
        </div>
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary" id="save-btn">@lang('admin.coupon.create')</button>
    </div>
</form>


@endsection