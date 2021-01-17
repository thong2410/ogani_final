@extends('layouts.app') 
@section('title', $title) 
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link active" href="{{ route('shop') }}">@lang('main.shop')</a></li>
        </ul>
    </div>
</div>
<div class="shop-layout">
    <div class="container mb-4">
        <div class="row">
            <div class="col-xl-3">
                <div class="shop-sidebar">
                    <button class="no-round-btn" id="filter-sidebar--closebtn">@lang('main.close_sidebar')</button>
                    <div class="shop-sidebar_department">
                        <div class="department_top mini-tab-title underline pink">
                            <h2 class="title">@lang('main.departments')</h2>
                        </div>
                        <div class="department_bottom">
                            <ul>
                                @foreach($getCategories as $cate)
                                <li> <a class="department-link @if(isset($cid) && $cate->cate_id == $cid) active @endif" href="{{ route('shop', $cate->cate_id) }}"><strong>{{ $cate->name }}</strong></a></li>
                                @foreach($cate->children as $child)
                                <li class="ml-4"> <a class="department-link @if(isset($cid) && $child->cate_id == $cid) active @endif" href="{{ route('shop', $child->cate_id) }}">{{ $child->name }}</a></li>
                                @endforeach @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="shop-sidebar">
                    <form>
                        <p>
                          <label for="range_amount"><h4>@lang('main.shop_detail.filter')</h4></label><br><br>
                          <input type="text" id="range_amount" readonly style="border:0; color:#f6931f; font-weight:bold;margin-bottom: 20px">
                          <input type="hidden" name='start_price' id='start_price'>
                          <input type="hidden" name="end_price" id="end_price">
                        </p>
                         
                        <div id="range_price"></div><br><br>
                        <button class="btn btn-danger btn-sm">@lang('main.shop_detail.submit')</button>
                    </form>
                </div>
                <div class="filter-sidebar--background" style="display: none"></div>
            </div>
            <div class="col-xl-9">
                <div class="shop-grid-list">
                    <div class="shop-products">
                        <div class="shop-products_top mini-tab-title underline pink">
                            <div class="row align-items-center">
                                <div class="col-6 col-xl-4">
                                    <h2 class="title">{{ $title }}</h2>
                                </div>
                                <div class="col-6 text-right" style="display: none;">
                                    <div id="show-filter-sidebar" style="display: none;">
                                        <h5> <i class="fas fa-bars"></i>@lang('main.show_sidebar')</h5>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-8">
                                    <div class="product-option justify-content-end">
                                        <div class="product-filter form-inline">
                                            <form method="POST" action="{{ route('set-sort') }}">
                                                {{ csrf_field() }}
                                                <select class="select-form" id="sort" name="sort" onchange="this.form.submit()">
                                                  <option value="default"@if(session('shop_sort') == 'default' || !session('shop_sort')) selected @endif>@lang('main.default')</option>
                                                  <option value="a-z"@if(session('shop_sort') == 'a-z') selected @endif>@lang('main.a-z')</option>
                                                  <option value="z-a"@if(session('shop_sort') == 'z-a') selected @endif>@lang('main.z-a')</option>
                                                  <option value="high-to-low-price"@if(session('shop_sort') == 'high-to-low-price') selected @endif>@lang('main.high_to_low_price')</option>
                                                  <option value="low-to-height-price"@if(session('shop_sort') == 'low-to-height-price') selected @endif>@lang('main.low_to_height_price')</option>
                                                </select>
                                            </form>
                                            &nbsp;&nbsp;
                                            <form method="POST" action="{{ route('set-limit') }}">
                                                {{ csrf_field() }}
                                                <select class="select-form" id="limit" name="limit" onchange="this.form.submit()">
                                                  <option value="12"@if(session('shop_limit') == '12') selected @endif>@lang('main.show') 12</option>
                                                  <option value="24"@if(session('shop_limit') == '24') selected @endif>@lang('main.show') 24</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Using column-->
                        </div>
                        <div class="shop-products_bottom">
                            <div class="row no-gutters-sm">
                            @if(count($products) > 0)
                                @if(isset($start_price) && isset($end_price))
                                    @php $countProd = 0; @endphp
                                    @foreach($products as $prod)
                                        @php $realPrice = $prod->unit_price - $prod->unit_price * ($prod->sale / 100); @endphp
                                        @if($realPrice >= $start_price && $realPrice <= $end_price)
                                            @php $countProd++ @endphp
                                        <div class="col-6 col-md-4">
                                            @include('subviews.items.block-product', $prod)
                                        </div>
                                        @endif
                                    @endforeach
                                    @if($countProd == 0)
                                    <div class="col-12 alert alert-danger text-center">@lang('main.no_result')</div>
                                    @endif
                                @else
                                    @foreach($products as $prod)
                                    <div class="col-6 col-md-4">
                                        @include('subviews.items.block-product', $prod)
                                    </div>
                                    @endforeach
                                @endif
                            @else
                                <div class="col-12 alert alert-danger text-center">@lang('main.no_result')</div>
                            @endif
                            </div>
                        </div>
                        {{ $products->links('vendor.pagination.shop') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection