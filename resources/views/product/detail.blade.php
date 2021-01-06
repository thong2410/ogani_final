@extends('layouts.app', [
        'seo' => true,
        'keywords' => $prod->seo_keywords,
        'description' => $prod->seo_description,
        'title' => $prod->seo_title,
        'image' => $prod->thumb->path .'/'. $prod->thumb->name
    ]) 
@section('title', $prod->prod_name) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('shop') }}">@lang('main.shop')</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('product.detail', $prod->product_id) }}">{{ $prod->prod_name }}</a></li>
        </ul>
    </div>
</div>

<div class="shop-layout">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="shop-detail">
                    <div class="row">
                        <div class="col-12">
                            <div id="show-filter-sidebar" style="display: none;">
                                <h5> <i class="fas fa-bars"></i>@lang('main.show_sidebar')</h5>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="shop-detail_img">
                                <div class="big-img">
                                    <div class="big-img_block"><img src="/{{ $prod->thumb->path }}/{{ $prod->thumb->name }}" alt="product image"></div>
                                </div>
                            </div>
                            <div class="img_control"></div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="shop-detail_info">
                                <h5 class="product-type color-type pink">{{ $prod->category->name }}</h5>
                                <h2 class="product-name">{{ $prod->prod_name }}</h2><br>
                                <p class="product-more">HSD đến ngày {{ $prod->hsd }}</p>
                                <p class="product-describe">{{ str_limit(strip_tags($prod->content), 120) }}</p><a class="product-more" href="javascript:void(0)" onclick="$('#ui-id-1').trigger('click');autoScrollTo('prod-desc');">@lang('main.product.view_more') <i class="arrow_carrot-2right"></i></a>
                                <div class="price-rate">
                                    <h3 class="product-price">
                                        <del>{{ number_format($prod->unit_price) }}₫</del>{{ number_format($prod->unit_price - $prod->unit_price * ($prod->sale / 100)) }}₫
                                    </h3>
                                    <!--<h5 class="product-rated"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star-half"></i><span>(15)</span></h5>-->

                                    <div class="mb-4 star-ratings d-inline-block">
                                        <div class="fill-ratings" style="width: {{ optional($prod->agvRating->first())->star * 20 }}%;">
                                            <span>★★★★★</span>
                                        </div>
                                        <div class="empty-ratings">
                                            <span>★★★★★</span>
                                        </div>
                                    </div>
                                    <small class="mb-4 text-muted">({{ count($reviews) }})</small>
                                </div>
                                <div class="quantity-select">
                                    <label for="quantity">@lang('main.product.quantity'):</label>
                                    <input class="select-quantity-product no-round-input" id="quantity" name="product-quantity" type="number" min="1" max="{{ $prod->quantity }}" value="1">
                                </div>
                                <div class="product-select">
                                    <button class="add-to-cart normal-btn outline pink" data-id="{{ $prod->product_id }}">@lang('main.product.add_to_cart')</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="shop-detail_more-info">
                                <div id="tab-so3" class="ui-tabs ui-corner-all ui-widget ui-widget-content">
                                    <ul class="mb-0 ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header" role="tablist">
                                        <li class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" role="tab" tabindex="-1" aria-controls="tab-1" aria-labelledby="ui-id-1" aria-selected="false" aria-expanded="false"><a href="#tab-1" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-1">@lang('main.product.description')</a></li>
                                        <li role="tab" tabindex="0" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active active" aria-controls="tab-2" aria-labelledby="ui-id-2" aria-selected="true" aria-expanded="true"><a href="#tab-2" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-2">@lang('main.product.detail')</a></li>
                                        <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" aria-controls="tab-3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"> <a href="#tab-3" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-3">@lang('main.product.customer_review')</a></li>
                                    </ul>
                                    <div id="tab-1" aria-labelledby="ui-id-1" role="tabpanel" class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="true" style="display: none;">
                                        <div class="description-block" id="prod-desc">
                                            <div class="description-item_block">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-md-12">
                                                        <div class="description-item_text">
                                                            <p>{!! $prod->content !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" aria-labelledby="ui-id-2" role="tabpanel" class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false" style="">
                                        <div class="specifications_block">
                                            <table class="shop_attributes table-bordered">
                                                <tbody>
                                                @if(count(json_decode($prod->detail)) > 0)
                                                    @foreach (json_decode($prod->detail) as $detail)
                                                        <tr>
                                                            <th>{{ $detail->info }}</th>
                                                            <td class="product_weight">{{ $detail->value }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="text-center">
                                                        <td>@lang('main.product.no_detail')</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="tab-3" aria-labelledby="ui-id-3" role="tabpanel" class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="true" style="display: none;">
                                        <div class="customer-reviews_block">
                                        <div class="list_review">
                                            @foreach ($reviews as $review)
                                            <div class="customer-review">
                                                <div class="row">
                                                    <div class="col-12 col-sm-3 col-lg-2">
                                                        <div class="customer-review_left">
                                                            <div class="customer-review_img text-center"><img class="img-fluid" src="/{{ $review->user->avatar }}" alt="customer image"></div>
                                                            <div class="customer-rate">
                                                            <div class="mb-4 star-ratings d-inline-block">
                                                                <div class="fill-ratings" style="width: {{ $review->rating * 20 }}%;">
                                                                    <span>★★★★★</span>
                                                                </div>
                                                                <div class="empty-ratings">
                                                                    <span>★★★★★</span>
                                                                </div>
                                                            </div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-9 col-lg-10">
                                                        <div class="customer-comment">
                                                            <h5 class="comment-date float-right">{{ $review->created_at }}</h5>
                                                            <h3 class="customer-name">{{ $review->user->fullname }}</h3>
                                                            <p class="customer-commented">{{ $review->content }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            </div>

                                            <div class="add-review">
                                                @if(Auth::check())
                                                <div class="add-review_top">
                                                    <h2>@lang('main.rating.add_review')</h2>
                                                </div>
                                                <div class="add-review_bottom">
                                                    <form action="" method="post" class="submitRating">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <textarea class="textarea-form" id="review" name="" cols="30" rows="4" placeholder="@lang('main.rating.message')"></textarea>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="rating">
                                                                    <h5>@lang('main.rating.your_rating'):</h5>
                                                                    <select class="star-rating" require>
                                                                        <option value="">@lang('main.rating.select_a_rating')</option>
                                                                        <option value="5">@lang('main.rating.excellent')</option>
                                                                        <option value="4">@lang('main.rating.very_good')</option>
                                                                        <option value="3">@lang('main.rating.average')</option>
                                                                        <option value="2">@lang('main.rating.poor')</option>
                                                                        <option value="1">@lang('main.rating.terrible')</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <input type="hidden" name="productId" value="{{ $prod->product_id }}">
                                                                <button class="normal-btn pink">@lang('main.rating.submit_review')</button>
                                                                <div class="alert alert-danger mb-4 print-error-msg mt-4" style="display:none">
                                                                        <ul></ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
