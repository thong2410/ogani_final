@extends('layouts.admin')

@section('title', trans('admin.coupon.coupondetail'))

@section('content')
<h3 class="mb-4">@lang('admin.coupon.coupondetail')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="{{route('admin.CouponDetail.show', $coupon_id)}}" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.coupon.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-4 col-xs-12 mb-2">
        <select class="form-control" name="status" id="role">
                    <option value="">---</option>
                    <option value="new" {{ isset($input['status']) && $input['status'] == 'new' ? 'selected' : '' }}>@lang('admin.coupon.status.new')</option>
                    <option value="used" {{ isset($input['status']) && $input['status'] == 'used' ? 'selected' : '' }}>@lang('admin.coupon.status.used')</option>
                    <option value="expired" {{ isset($input['status']) && $input['status'] == 'expired' ? 'selected' : '' }}>@lang('admin.coupon.status.expired')</option>
        </select>
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        @if(isset($input['status']) | isset($input['keyword']))<a href="{{route('admin.CouponDetail.show', $coupon_id)}}"><button class="btn btn-info" type="button"><i class="fas fa-reply-all"></i></button></a>@endif
    </div>
  </div>
</form>
<hr/>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">@lang('admin.coupon.coupon_code')</th>
                <th scope="col">@lang('admin.coupon.coupon_status')</th>
                <th scope="col">@lang('admin.coupon.username')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($CouponDetail) > 0)
            @foreach ($CouponDetail as $coupon)
            <tr>
                <td>{{ $coupon->code }}</td>
                <td><span class="badge @if($coupon->status == 'new') badge-success @elseif($coupon->status == 'used') badge-danger @else badge-warning @endif"> @lang('admin.coupon.status.'.$coupon->status) </span></td>
                <td>{{ $coupon->username }}</td>
                <td>
                    <form action="{{ url('admin/coupondetail/destroy', $coupon->id) }}" method="GET"
                        class="form-inline">
                        <button type="submit" class="btn btn-sm btn-outline-danger mr-1" ><i class="fa fa-trash"
                                aria-hidden="true"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"><a href="{{url('admin/coupondetail/del_used', $coupon_id)}}">
                    <button class="btn btn-danger" id="del_coupon_used" data-coupon="{{ $coupon_id }}" >@lang('admin.coupon.delete_coupon')</button>
                </a> </td>
            </tr>
            @else
            <tr>
                <td colspan="3" class="text-center">@lang('admin.coupon.not_found')</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{{ $CouponDetail->appends($input)->links() }}

@endsection