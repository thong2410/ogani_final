<div class="product pink">
    <h5 class="deal-discount @if($prod->sale == 0) deal-discount-hidden @endif">-{{ $prod->sale }}%</h5>
    <a class="product-img" href="{{ route('product.detail', $prod->product_id) }}"><img src="/{{ $prod->thumb->path }}/{{ $prod->thumb->name }}" alt=""></a>
    <h5 class="product-type">{{ $prod->category->name }}</h5>
    <h3 class="product-name">{{ $prod->prod_name }}</h3>
    <h3 class="product-price">{{ number_format($prod->unit_price - $prod->unit_price * ($prod->sale / 100)) }}₫
    @if($prod->sale > 0)<del>{{ number_format($prod->unit_price) }}₫</del>@endif
    </h3>
    <div class="product-select">
        <button class="add-to-wishlist round-icon-btn pink @if($prod->wished->first()) active @endif" data-id="{{ $prod->product_id }}"><i class="icon_heart_alt"></i></button>
        <button class="add-to-cart round-icon-btn pink" data-id="{{ $prod->product_id }}">  <i class="icon_bag_alt"></i></button>
        <button class="quickview round-icon-btn pink" data-id="{{ $prod->product_id }}"><i class="far fa-eye"></i></button>
    </div>
</div>