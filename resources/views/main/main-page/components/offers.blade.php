<div class="row-content offers">
    <h2 class="title">تخفیف های آنیف</h2>
    <div class="items offer-items">
        @foreach($sortedWithOff as $store)
            <div class="item offer-item">
                <div class="image-box">
                    <a href="{{route('store.show', ['store'=> $store->username])}}"><img src="{{$store->image}}" alt="image-box"></a>
                    <span class="offer-percent">تا {{ $store->max_off }}٪</span>
                </div>
                <div class="caption-box">
                    <div class="logo">
                        <img src="{{$store->icon}}" alt="لوگو">
                    </div>
                    <div class="info">
                        <div class="title"><a href="{{route('store.show', ['store'=> $store->username])}}">{{ $store->name }}</a></div>
                        <div class="location"><i class="fa fa-map-marker"></i>{{ $store->address }}</div>
                    </div>
                </div>
            </div>
        @endforeach

        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
                {{--<a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>--}}
                {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
                {{--<div class="logo">--}}
                    {{--<img src="/img/item-logo.png" alt="لوگو">--}}
                {{--</div>--}}
                {{--<div class="info">--}}
                    {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
                    {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>