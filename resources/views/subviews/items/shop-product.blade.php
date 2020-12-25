
<div class="col-12 col-lg-6 d-flex">
    <article class="entity-block entity-hover-shadow text-center entity-preview-show-up">
        <div class="entity-preview">
            <div class="embed-responsive embed-responsive-4by3"><img class="embed-responsive-item"
                    src="/{{ $prod->thumb->path }}/{{ $prod->thumb->name }}" alt=""></div>
            <div class="with-back entity-preview-content">
                <div class="mx-auto mt-auto mb-4 text-center"><a class="btn-wide mr-2 btn btn-theme"
                        href="{{ route('product.detail', $prod->product_id) }}">@lang('main.product.buy_now')</a><a class="btn-icon btn btn-theme"
                        href="{{ route('product.detail', $prod->product_id) }}"><i class="fas fa-heart"></i></a></div>
            </div>
        </div>
        <div class="pb-4 entity-content">
            <h4 class="entity-title"><a class="content-link" href="{{ route('product.detail', $prod->product_id) }}">{{ $prod->prod_name }}</a></h4>
            <div class="entity-price">{{ number_format($prod->unit_price) }}<span class="currency">₫</span> <span
                class="price-unit">/ {{ $prod->unit }}</span></div>
        </div>
    </article>
</div>