<div class="row-content offers">
    <h2 class="title">تخفیف های آنیف</h2>
    <div class="items offer-items">
        @foreach($sortedWithOff as $store)
            <div class="item offer-item">
                <div class="image-box">
                    <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
                    <span class="offer-percent">تا {{ $store->max_off }}٪</span>
                </div>
                <div class="caption-box">
                    <div class="logo">
                        <img src="/img/item-logo.png" alt="لوگو">
                    </div>
                    <div class="info">
                        <div class="title"><a href="#">{{ $store->name }}</a></div>
                        <div class="location"><i class="fa fa-map-marker"></i>{{ $store->address }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>