<div class="deal-block">
    <div class="deal-block_detail">
        <h5 class="deal-discount">-{{ $deal->sale }}%</h5>
        <div class="deal-img">
            <a href="{{ route('product.detail', $deal->product_id) }}"><img src="/{{ $deal->thumb->path }}/{{ $deal->thumb->name }}" alt="product image"></a>
        </div>
        <div class="deal-info text-center">
            <h5 class="color-type pink deal-type">{{ $deal->category->name }}</h5><a class="deal-name" href="shop_detail.html">{{ $deal->prod_name }}</a>
            <h3 class="deal-price">{{ number_format($deal->unit_price - $deal->unit_price * ($deal->sale / 100)) }}₫
                <del>{{ number_format($deal->unit_price) }}₫</del>
            </h3>
        </div>
        <div class="deal-select text-center">
            <button class="add-to-wishlist round-icon-btn pink @if($deal->wished->first()) active @endif" data-id="{{ $deal->product_id }}"> <i class="icon_heart_alt"></i></button>
            <button class="add-to-cart round-icon-btn pink pink" data-id="{{ $deal->product_id }}">  <i class="icon_bag_alt"></i></button>
            <button class="quickview round-icon-btn pink" data-id="{{ $deal->product_id }}"><i class="far fa-eye"></i></button>
        </div>
    </div>
</div>