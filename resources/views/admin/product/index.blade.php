@extends('layouts.admin')

@section('title', trans('admin.product.products'))

@section('content')
<h3 class="mb-4">@lang('admin.product.products')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="{{route('admin.product.index')}}" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.product.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        @if(isset($input['keyword']))<a href="{{route('admin.product.index')}}"><button class="btn btn-info" type="button"><i class="fas fa-reply-all"></i></button></a>@endif
    </div>
  </div>
</form>
<hr/>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('admin.product.thumbnail')</th>
                <th scope="col">@lang('admin.product.name')</th>
                <th scope="col">@lang('admin.product.unit')</th>
                <th scope="col">@lang('admin.product.unit_price')</th>
                <th scope="col">@lang('admin.product.sale')</th>
                <th scope="col">@lang('admin.product.quantity')</th>
                <th scope="col">@lang('admin.product.status')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($products) > 0)
                @foreach ($products as $prod)
                <tr>
                    <td>{{ $prod->product_id }}</td>
                    <td class="text-center"><img src="/{{ $prod->thumb->path }}/{{ $prod->thumb->name }}" class="thumbnail" width="70px" height="70px"></td>
                    <td><a href="{{ route('product.detail', $prod->product_id) }}" target="_blank"><b>{{ $prod->prod_name }}</b></a></td>
                    <td>{{ $prod->unit }}</td>
                    <td>{{ number_format($prod->unit_price) }}₫</td>
                    <td>{{ $prod->sale }}%</td>
                    <td>{{ number_format($prod->quantity) }}</td>
                    <td><span class="badge @if($prod->status == 'feature') badge-success @else badge-info @endif">{{ trans('admin.product.'.$prod->status) }}</span></td>
                    <td>
                        <form action="{{ route('admin.product.destroy', $prod->product_id) }}" method="POST"
                            class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <a href="{{ route('admin.product.edit', $prod->product_id) }}">
                                <button type="button" class="btn btn-sm btn-outline-success mr-1 mb-1"><i class="fa fa-pen" aria-hidden="true"></i></button>
                            </a>
                            <a href="{{ route('admin.rating.show', $prod->product_id) }}">
                                <button type="button" class="btn btn-sm btn-outline-warning mr-1 mb-1"><i class="fa fa-star" aria-hidden="true"></i></button>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center">@lang('admin.product.not_found')</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
{{ $products->appends($input)->links() }}

@endsection
