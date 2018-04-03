@extends('main.master')

@section('custom-header')
    <header>
        <div id="slider-s" class="stores">
                <div class="store" style="background: url({{$store->images[1]}}) no-repeat 50% 50%"></div>
                <div class="store" style="background: url({{$store->images[2]}}) no-repeat 50% 50%"></div>
                <div class="store" style="background: url({{$store->images[3]}}) no-repeat 50% 50%"></div>
        </div>
        <div class="information__section">
            <div class="information">
                <div class="logo">
                    <img width="84px" src="{{$store->icon}}" alt="لوگو">
                </div>
                <div class="info">
                    <div class="name">{{$store->name}}</div>
                    <div class="location"><i class="fa fa-map-marker"></i>{{$store->address}}</div>
                </div>
            </div>
            <div class="online">
                <div>.</div>
                <!--<img src="assets/img/Shape-green-.png" alt="on">-->
                <span>رستوران سفارش آنلاین می پذیرد</span>
            </div>
            <div class="time-work">
                <div class="morning">
                    <i class="fa fa-sun-o" aria-hidden="true"></i>
                    <span>{{$store->working_hours}}</span>
                </div>
                <div class="night">
                    <i class="fa fa-moon-o" aria-hidden="true"></i>
                    <span>{{$store->working_hours}}</span>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
<div class="row container mb10px ">
        <div class="row-content flex-row MIC_P flex-end">
            <div class="MIN">
                <span id="store-menu">منوی رستوران</span>
                <span id="store-info">اطلاعات رستوران</span>
                <span id="customer-comments">نظرات مشتریان</span>
            </div>
            <div class="Points">
                <span>امتیاز</span>
                <div class="star">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row container mb10px">
        <div class="row-content flex-row category-container flex-end">
            <div id="categories" class="category">
                <div class="category-section__nav">
                      <div class="category-section__nav-btn">
                          <div class="owl-carousel owl-theme sub-menu">
                            @foreach($categories as $category)
                                <div class="item"><p><a href="#{{$category->id}}">{{$category->name}}</a></p></div>
                            @endforeach
                        </div>
                      </div>
                </div>
            </div>
            <div id="placement" style="display:none;">
                <h3></h3>
            </div>
            <div class="number-of-member">
                <div class="member">
                    <span>تعداد اعضا</span>
                    <span>{{ $store->member_count }}</span>
                </div>
                <form action="{{ route('customer.joinToCrm' , [ 'store' => $store ]) }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn-btn--yellow">
                        عضویت در باشگاه مشتریان
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="row container mb10px">
        <div class="row-content flex-row show-products flex-end">
            <div id="show-product-box" class="show-products-item">
                @foreach($categories as $category)
                    <div class="title">
                        <h3 id="{{ $category->id }}">{{ $category->name }}</h3>
                    </div>
                    <hr>
                    <div class="product">
                        <div class="items offer-items">
                            @foreach($category->product as $product)
                                <div class="item offer-item">
                                    <div class="image-box">
                                        <a href="#"><img src="/img/offer-item.jpeg" alt="image-box"></a>
                                        <span class="offer-percent">تا {{$product->off}}٪</span>
                                    </div>
                                    <div class="caption-box">
                                        <div class="logo">
                                            <img src="/img/item-logo.png" alt="لوگو">
                                        </div>
                                        <div class="info">
                                            <div class="title"><a href="#">{{ $product->name }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="show-information-box" style="display:none;" class="show-products-item">

                    <div class="title">
                        <h2><i class="fa fa-map-marker" aria-hidden="true"></i>آدرس</h2>
                    </div>
                    <div class="info-content">
                        <h3>
                            {{ $store->address }}
                        </h3>
                    </div>
                    <hr>

                    <div class="title">
                        <h2><i class="fa fa-clock-o" aria-hidden="true"></i>ساعت کاری</h2>
                    </div>
                    <div class="info-content">
                        <h3>
                            {{ $store->working_hours }}
                        </h3>
                    </div>
                    <hr>

                    <div class="title">
                        <h2><i class="fa fa-circle-o-notch" aria-hidden="true"></i>مناطق تحت پوشش</h2>
                    </div>
                    <div class="info-content">
                            
                    </div>
                    <hr>

                    <div class="title">
                        <h2><i class="fa fa-check-circle-o" aria-hidden="true"></i>امکانات</h2>
                    </div>
                    <div class="info-content">
                        <div class="features">
                            <div class="feature-item">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                امکانات
                            </div>
                            <div class="feature-item">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                امکانات
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="title">
                        <h2><i class="fa fa-map-marker" aria-hidden="true"></i>آدرس روی نقشه</h2>
                    </div>
                    <div class="info-content">
                        
                    </div>
                    <hr>
            </div>
            <div class="cart">
                <div class="header">
                    <span>سبدخرید</span>
                    <div class="cart-icon">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <!-- <div class="number-pro">۲</div> -->
                    </div>
                </div>
                <div class="selected-pro">
                    <div class="products">
                        <span>جوجه کباب</span>
                        <span>۱۸۰۰۰</span>
                        <div class="number-of-product">
                            <div class="add"><a href="#">+</a></div>
                            <div class="number">۲</div>
                            <div class="sub"><a href="#">-</a></div>
                        </div>
                    </div>
                    <hr>
                    <div class="products">
                        <span>جوجه کباب</span>
                        <span>۱۸۰۰۰</span>
                        <div class="number-of-product">
                            <div class="add"><a href="#">+</a></div>
                            <div class="number">۲</div>
                            <div class="sub"><a href="#">-</a></div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="order-amount">
                    <span>مبلغ سفارش :</span>
                    <span>۳۶۰۰۰</span>
                </div>
                <hr>
                <div class="delivery-type">
                    <span>تحویل غذا :</span>
                    <span>در محل رستوران</span>
                    <span>ارسال به شما</span>
                </div>
                <button class="btn-order">
                    <a href="#">ثبت سفارش</a>
                </button>
            </div>
        </div>
    </div>

@endsection


@section('custom-scripts')
    <script src="/js/custom.js"></script>
    <script type="text/javascript">

        $('.owl-carousel').owlCarousel({
            rtl:true,
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    
        var owlObject ={
                   rtl: true,
                   margin : 10,
                   dots : false,
                   responsive: {
                       0: {
                           items: 1
                       },
                       600: {
                           items: 3
                       },
                       1000: {
                           items: 4
                       },
                       1200: {
                           items: 6
                       }
                   }
             };
    
        var SliderS = $('#slider-s');
        var CategoryTitle = $('#category-title');
        CategoryTitle.owlCarousel(owlObject);
    
        SliderS.owlCarousel({
            rtl:true,
            items:1,
            loop:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true
        });
    
        $('#best-sellers__next').click(function () {
            bestSeller.trigger('next.owl.carousel');
        });
        $('#best-sellers__prev').click(function () {
            bestSeller.trigger('prev.owl.carousel');
        });        

        $('.MIN span').click(function(e){
            e.preventDefault();
            $(this).parents().find('.MIN span').each(function(){
                $(this).removeClass('MIN-hover');
            });
            $(this).addClass('MIN-hover');
            // alert($(this).attr('id'));
            var menu_id = $(this).attr('id')
            switch(menu_id) {
                case 'store-menu':
                    // alert(menu_id);
                    $('#placement').css('display','none');
                    $('#categories').css('display','flex');
                    $('#show-product-box').css('display','flex');
                    $('#show-information-box').css('display','none');
                    break;
                case 'store-info':
                    // alert(menu_id);
                    $('#categories').css('display','none');
                    $('#placement h3').html($(this).html());
                    $('#placement').css('display','flex');
                    $('#show-product-box').css('display','none');
                    $('#show-information-box').css('display','flex');
                    break;
                case 'customer-comments':
                    // alert(menu_id);
                    $('#categories').css('display','none');
                    $('#placement h3').html($(this).html());
                    $('#placement').css('display','flex');
                    $('#show-product-box').css('display','none');
                    $('#show-information-box').css('display','none');
                    break;
                default:
                    //code block
            }
        });

    </script>
@endsection