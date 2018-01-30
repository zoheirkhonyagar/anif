<div class="row-content best-restaurant">
    <h2 class="title">برترین رستوران ها</h2>
    <div class="items offer-items">
        @foreach($storesWithRank as $store)
            <div class="item offer-item">
                <div class="image-box">
                    <div class="logo-best-restaurant">
                    <a href="{{route('store.show', ['storeUsername'=> $store->username])}}"><img src="{{$store->icon}}" alt="image-box"></a>
                    </div>
                </div>
                <div class="caption-box">
                    <div class="info">
                        <div class="title"><a href="{{route('store.show', ['storeUsername'=> $store->username])}}">{{ $store->name }}</a></div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--<div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>
        <div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>
        <div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>
        <div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>
        <div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>
        <div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>
        <div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>
        <div class="item offer-item">
            <div class="image-box">
                <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
            </div>
            <div class="caption-box">
                <div class="info">
                    <div class="title"><a href="#">رستوران ملل</a></div>
                </div>
            </div>
        </div>--}}
    </div>
</div>