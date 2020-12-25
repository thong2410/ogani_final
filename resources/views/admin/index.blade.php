@extends('layouts.admin')

@section('title', trans('main.dashboard'))
 
@section('content')
<div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="st-card">
                                <div class="st-card__body d-flex align-items-center">
                                    <div class="min-width-0 mr-auto">
                                        <h4 class="text-primary font-weight-bold">{{ number_format($total_revenue_this_month) }}₫</h4>
                                        <div class="text-truncate text-muted">@lang('admin.home.total_revenue_this_month')</div>
                                    </div>
                                    <i class="fad fa-2x text-primary-300 fa-sack-dollar"></i>
                                </div>
                            </div>
<!-- .st-card -->
                        </div>
<!-- .col- -->
                        <div class="col-md-6 col-xl-3">
                            <div class="st-card">
                                <div class="st-card__body d-flex align-items-center">
                                    <div class="min-width-0 mr-auto">
                                        <h4 class="text-info font-weight-bold">{{ number_format(count($products_in_stock)) }}</h4>
                                        <div class="text-truncate text-muted">@lang('admin.home.products_in_stock')</div>
                                    </div>
                                    <i class="fad fa-2x text-info-300 fa-box-full"></i>
                                </div>
                            </div>
<!-- .st-card -->
                        </div>
<!-- .col- -->
                        <div class="col-md-6 col-xl-3">
                            <div class="st-card">
                                <div class="st-card__body d-flex align-items-center">
                                    <div class="min-width-0 mr-auto">
                                        <h4 class="text-danger font-weight-bold">{{ number_format(count($total_order_this_month)) }}</h4>
                                        <div class="text-truncate text-muted">@lang('admin.home.total_order_this_month', ['month' => 12])</div>
                                    </div>
                                    <i class="fad fa-2x text-danger-300 fa-shopping-cart"></i>
                                </div>
                            </div>
<!-- .st-card -->
                        </div>
<!-- .col- -->
                        <div class="col-md-6 col-xl-3">
                            <div class="st-card">
                                <div class="st-card__body d-flex align-items-center">
                                    <div class="min-width-0 mr-auto">
                                        <h4 class="text-success font-weight-bold">{{ number_format(count($orders_delivered)) }}</h4>
                                        <div class="text-truncate text-muted">@lang('admin.home.orders_delivered')</div>
                                    </div>
                                    <div class="">
                                        <i class="fad fa-2x text-success-300 fa-truck"></i>
                                    </div>
                                </div>
                            </div>
<!-- .st-card -->
                        </div>
<!-- .col- -->
                    </div>
          
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="st-card">
                                <header class="st-card__header">
                                    <h5 class="st-card__title">@lang('admin.home.chart_order')</h5>
                                </header>
                                <div class="st-card__body p-4">
                                <div id="order-status-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="st-card st-card--fixed-height">
                                <header class="st-card__header">
                                    <h5 class="st-card__title">@lang('admin.home.chart_order_by_month')</h5>
                                </header>
                                <div class="st-card__body p-4">
                                <div id="order-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="st-card st-card--fixed-height">
                                <header class="st-card__header">
                                    <h5 class="st-card__title">@lang('admin.home.new_orders')</h5>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin.order.index') }}">
                                            <button type="button" class="btn btn-outline-light">@lang('admin.home.view_all')</button>
                                        </a>
                                    </div>
                                </header>
                                <div class="st-card__body">
                                    <div class="scrollable">
                                        <div class="scrollable__container">
                                            <div class="st-card__content">
                                                <div class="st-timeline st-timeline--large-points">
                                                    @foreach($new_orders as $order)
                                                    <div class="st-timeline__item">
                                                            {!! trans('admin.home.status_str.'.$order->order_status) !!}
                                                            <div class="st-timeline__body">
                                                                <div class="d-flex mb-2">
                                                                    <h6 class="mb-0 mr-auto">@lang('admin.home.order_item', ['id' => $order->order_id]) - {!! trans('admin.order.status_label.'.$order->order_status) !!}</h6>
                                                                    <span class="fz-sm">{{ $order->created_at->diffForHumans() }}</span>
                                                                </div>
                                                                <div class="fz-sm text-muted">
                                                                    {{ $order->order_address }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
<!-- .st-timeline__item -->
                                                </div>
<!-- .st-timeline -->
                                            </div>
<!-- .st-card__content -->
                                        </div>
<!-- .scrollable__container -->
                                    </div>
<!-- .scrollable -->
                                </div>
<!-- .st-card__body -->
                            </div>
<!-- .st-card -->
                        </div>
<!-- .col -->
                        <div class="col-lg-6">
                            <div class="st-card st-card--fixed-height">
                                <header class="st-card__header">
                                    <h5 class="st-card__title">@lang('admin.home.new_reviews')</h5>
                                </header>
                                <div class="st-card__body">
                                    <div class="scrollable">
                                        <div class="scrollable__container">
                                            <div class="st-card__content table-responsive">
                                                <table class="table table-borderless table--valign-middle mb-0">
                                                    <tbody>
                                                    <tr class="bg-light">
                                                        <th>@lang('admin.home.product')</th>
                                                        <th>@lang('admin.home.rating')</th>
                                                        <th>@lang('admin.home.time')</th>
                                                    </tr>
                                                    @foreach($new_reviews as $review)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="/{{ $review->product->thumb->path }}/{{ $review->product->thumb->name }}" alt="product" class="avatar rounded img-thumbnail">
                                                                <a href="{{ route('admin.rating.show', $review->product_id) }}"><h6>{{ $review->product->prod_name }}</h6></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                    <div class="star-ratings d-inline-block">
                                                                                    <div class="fill-ratings" style="width: {{ $review->rating * 20 }}%;">
                                                                                        <span>★★★★★</span>
                                                                                    </div>
                                                                                    <div class="empty-ratings">
                                                                                        <span>★★★★★</span>
                                                                                    </div>
                                                                    </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="fz-sm">{{ $review->created_at->diffForHumans() }}</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody></table>
                                            </div>
<!-- .table-responsive -->
                                        </div>
<!-- .scrollable__container -->
                                    </div>
<!-- .scrollable -->
                                </div>
<!-- .st-card__body -->
                            </div>
<!-- .st-card -->
                        </div>
<!-- .col -->
                    </div>
                
@endsection