    <div class="quickview-box"> <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times"></i></button>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="shop-detail_img">
                    <div class="big-img big-img_qv">
                        <div class="big-img_block"><img src="/{{ $prod->thumb->path }}/{{ $prod->thumb->name }}" alt="product image"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="shop-detail_info">
                    <h5 class="product-type color-type pink">{{ $prod->category->name }}</h5>
                    <a class="product-name" href="{{ route('product.detail', $prod->product_id) }}">{{ $prod->prod_name }}</a>
                    <div class="price-rate">
                        <h3 class="product-price">
                            <del>{{ number_format($prod->unit_price) }}₫</del>{{ number_format($prod->unit_price - $prod->unit_price * ($prod->sale / 100)) }}₫
                        </h3>
                    </div>
                    <p class="product-describe">{{ str_limit(strip_tags($prod->content), 220) }}</p>
                    <div class="quantity-select"> <label for="quantity">@lang('main.product.quantity'):</label> 
                    <input class="select-quantity-product no-round-input" id="quantity" name="product-quantity" type="number" min="1" max="{{ $prod->quantity }}" value="1"> </div>
                    <div class="product-select"> 
                    <button class="add-to-cart normal-btn outline pink" data-id="{{ $prod->product_id }}">@lang('main.product.add_to_cart')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
