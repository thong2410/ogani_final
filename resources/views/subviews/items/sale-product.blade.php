<div class="col-12">
                                <div class="mini-product column">
                                    <div class="mini-product_img">
                                        <a href="{{ route('product.detail', $prod->product_id) }}"><img src="/{{ $prod->thumb->path }}/{{ $prod->thumb->name }}" alt=""></a>
                                    </div>
                                    <div class="mini-product_info"> <a href="{{ route('product.detail', $prod->product_id) }}">{{ $prod->prod_name }}</a>
                                        <p>{{ number_format($prod->unit_price - $prod->unit_price * ($prod->sale / 100)) }}₫
                                            <del>{{ number_format($prod->unit_price) }}₫</del>
                                       ư
                                        </p>
                                    </div>
                                </div>
                            </div>