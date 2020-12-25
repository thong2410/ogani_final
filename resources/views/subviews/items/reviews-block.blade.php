<div class="customer-satisfied_block">
    <div class="customer-img mx-auto"><img src="/{{ $review->user->avatar }}" alt="customer"></div>
    <div class="customer-info">
        <h5 class="customer-name">{{ $review->user->fullname }}</h5>
        <p class="customer-comment">{{ str_limit($review->content, 120) }}</p>
        <div class="customer-rate">
            <div class="mb-4 star-ratings d-inline-block">
                <div class="fill-ratings" style="width: {{ optional($review->product->agvRating->first())->star * 20 }}%;">
                    <span>★★★★★</span>
                </div>
                <div class="empty-ratings">
                    <span>★★★★★</span>
                </div>
            </div>           
        </div>
    </div>
</div>