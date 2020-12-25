@if(count($products)>0)
@foreach ($products as $prod) 
    <div class="search-item">
        <div class="row">
            <div class="col-md-2 col-sm-2">
                <img src="/{{ $prod->thumb->path }}/{{ $prod->thumb->name }}" class="thumbnail" width="70px" height="70px">
            </div>
            <div class="col-md-8 col-sm-6">
                <h5 class="product-type color-type pink">{{ $prod->category->name }}</h5>
                <h2 class="product-name"><a href="{{ route('product.detail', $prod->product_id) }}">{{ $prod->prod_name }}</a></h2>
                <p class="product-describe">{{ str_limit(strip_tags($prod->content), 60) }}</p>
            </div>
            <div class="col-md-2 col-sm-4 pt-4">
            <h3 class="product-price">@if($prod->sale > 0)<del>{{ number_format($prod->unit_price) }}₫</del>@endif {{ number_format($prod->unit_price - $prod->unit_price * ($prod->sale / 100)) }}₫</h3>
            <div class="mt-2 mb-4 star-ratings d-inline-block">
                <div class="fill-ratings" style="width: {{ optional($prod->agvRating->first())->star * 20 }}%;">
                    <span>★★★★★</span>
                </div>
                <div class="empty-ratings">
                    <span>★★★★★</span>
                </div>
            </div>
            </div>
        </div>
    </div>
@endforeach
@else
    <p class="text-center text-muted p-4">@lang('main.cart.product_does_not_exist')</p>
@endif