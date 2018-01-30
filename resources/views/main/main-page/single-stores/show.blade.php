@extends('main.master')

@section('custom-styles')
    <style>
        /*------------ Slider stores ------------*/
        .stores{
            display: flex;
        }

        .store {
            background-size: cover !important;
            height: 320px;
            z-index: 0;
            display: flex;
            align-items: center;
        }

        .store__item-info {
            margin-right: 3%;
            margin-top: 10%;
        }

        .stores .owl-controls {
            position: absolute;
            bottom: 0;
            right: 50%;
        }

        /*---------------- next prev--------------*/

        .product-section__nav{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-section__nav-btn button{
            border: none;
            outline: none;
            background: #5d5d5d;
            padding: 8px 10px;
            border-radius: 10px;
        }

        .product-section__nav-btn button i{
            color: #4d4d4d;
            font-size: 1.2em;
        }

        .product-section__nav-btn button:hover{
            opacity: 0.5;
            cursor: pointer;
        }

        /*------------ information__section -------------*/

        .information__section{
            padding:20px 25px ;
            background-color: #ebebeb;
            margin-top: 7px;
            margin-bottom: 7px;
            border: 1px solid rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .information{
            display: flex;
        }

        .information .logo {
            margin-left: 0px;
            width: 35%;
        }

        .information .logo img{
            width: 80%;
        }

        .information .info{
            font-weight: 400;
            margin-top: 20px;
            font-size: 1.2em;
        }

        .information .info .name{
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .information .info .fa{
            margin-left: 5px;
        }


        .information__section .online{
            display: flex;
            font-size: 1.1em;
        }

        /*.information__section .online img{*/
        /*margin-left: 5px;*/
        /*}*/

        .information__section .online div{
            background-color: #39b54a;
            padding: .01rem .4rem;
            border-radius: 100%;
            border: 3px;
            border-color: #3d9366;
            margin-left: 5px;
            color: #39b54a;
        }

        .information__section .time-work{
            display: flex;
            flex-direction: column;
            direction: ltr;
            font-size: 1.2em;
        }

        .information__section .time-work .morning .fa{
            color: #fabc05;
            margin-right: 5px;
            font-size: 1.3em;
            margin-bottom: 15px;
        }

        .information__section .time-work .night .fa{
            color: #a6a3a3;
            margin-right: 5px;
            font-size: 1.3em;
        }

        /*-------------content-----------*/

        /*#tabs-icons .ui-tabs-nav .ui-icon {*/
        /*display: inline-block;*/
        /*}*/

        .row-content-MIC_P{
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }

        .MIN{
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color: #ebebeb;
            border: 1px solid rgba(0,0,0,0.1);
            flex-basis: 70%;
            font-size: 1.1em;
        }

        .MIN span:hover{
            color: #fabc05;

        }
        .MIN span{
            margin-right: 20px;
            margin-left: 20px;
        }
        .Points {
            display: flex;
            padding: 15px;
            background-color: #ebebeb;
            border: 1px solid rgba(0, 0, 0, 0.1);
            flex-basis: 30%;
            align-items: center;     /*???????????????????????*/
            margin-right: 10px;
            text-align: center;
            font-size: 1.1em;
        }


        .Points .star{
            color: #fabc05;
            margin-right: 10px;
        }

        /*--------------- row-content-category ----------------*/

        .category {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            padding: 50px;
            background-color: #ebebeb;
            border: 1px solid rgba(0,0,0,0.1);
            flex-basis: 70%;
            font-size: 1.1em;
        }

        .category .title{
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
            margin-right: 60px;
        }



        .category a:hover{
            color: #fabc05;
        }

        .category-section__nav-btn {
            display: flex;
            flex-basis: 100%;
            justify-content: space-between;
        }

        .row-content-category .category .category-section__nav{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0px;
        }

        .category-section__nav-btn button{
            justify-content: space-between;
            border: none;
            outline: none;
            background: inherit;
            /*padding: 8px 10px;*/
            /*border-radius: 10px;*/
        }

        .category-section__nav-btn .next , .category-section__nav-btn .prev{
            display: flex;
            flex-direction: row !important;
            justify-content: space-between;

        }

        .category-section__nav-btn button i{
            color: #4d4d4d;
            font-size: 1.2em;
        }

        .category-section__nav-btn button:hover{
            opacity: 0.5;
            cursor: pointer;
        }

        .row-content-category {
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }

        .number-of-member {
            display: flex;
            flex-direction: column;
            padding: 32px;
            background-color: #ebebeb;
            border: 1px solid rgba(0, 0, 0, 0.1);
            flex-basis: 30%;
            align-items: center;     /*???????????????????????*/
            margin-right: 10px;
            text-align: center;
            font-size: 1.1em;
        }

        .number-of-member  .member span{
            margin-left: 15px;

        }

        .number-of-member .btn-btn--yellow{
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #fabc05;
            border: none;
            border-radius: 5px;
        }

        .number-of-member .btn-btn--yellow a{
            color: #fff;
            border: 1px;
        }

        /*--------------- row-content-show-products ----------------*/

        .row-content-show-products {
            display:flex;
            justify-content: space-between;
            align-items: center;
        }

        .show-products{
            display: flex;
            justify-content: space-between;
            padding: 45px;
            background-color: #ebebeb;
            border: 1px solid rgba(0,0,0,0.1);
            flex-basis: 70%;
            font-size: 1.1em;
        }

        .cart {
            display: flex;
            flex-direction: column;
            background-color: #ebebeb;
            border: 1px solid rgba(0, 0, 0, 0.1);
            flex-basis: 30%;
            margin-right: 10px;
            font-size: 1.1em;
            margin-top: 0;
        }

        .header{
            display: flex;
            justify-content: space-between;
            background: #404040;
            align-items: center;
        }

        .header span{
            color: #fff;
        }

        /*.header .cart-icon {*/
        /*align-items: center;*/
        /*}*/

        .header .cart-icon .fa{
            color: #fff;
            display: flex;
            justify-content: center;
        }

        .header .cart-icon .number-pro{
            color: #404040;
            padding: 1rem 1rem;
        }

        .cart .btn-order a{
            color: #fff;
            border: 1px;
        }

        .selected-pro .products{
            display: flex;
            justify-content:space-between;
        }

        .selected-pro .products span{
            margin: 20px 20px;
        }

        .cart .selected-pro .number-of-product{
            display: flex;
            flex-direction: row;
            align-items: center;
            direction: ltr;
            margin: 20px ;
            margin-bottom: 10px;

        }

        .cart .selected-pro .number-of-product .add , .cart .selected-pro .number-of-product .number ,.cart .selected-pro .number-of-product .sub  {
            padding: .23rem .5rem;

            background-color: #ebebeb;
            border: 1px solid rgba(0,0,0,0.5);
            border-radius: 5px;
            margin-right: 5px;
        }

        .cart .selected-pro .number-of-product .add{
            background-color: #399f11;
        }

        .cart .selected-pro .number-of-product .sub{
            padding: .22rem .6rem;
            background-color: #e60e1d;
        }

        .cart .selected-pro .number-of-product .add a ,.cart .selected-pro .number-of-product .sub a {
            color: white;
        }

        .cart .order-amount{
            display: flex;
            justify-content: space-between;
            margin: 15px;
        }

        .cart .delivery-type{
            display: flex;
            justify-content: space-between;
            margin: 15px;
            margin-right: 20px;
        }

        .cart .btn-order{
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #04974b;
            border: none;
            border-radius: 5px;

        }

        .row-content-show-products .show-products .product{
            /*margin-top: ;*/
        }
        .row-content-show-products {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        /*
 *  Owl Carousel - Animate Plugin
 */
        .owl-carousel .animated {
            -webkit-animation-duration: 1000ms;
            animation-duration: 1000ms;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }
        .owl-carousel .owl-animated-in {
            z-index: 0;
        }
        .owl-carousel .owl-animated-out {
            z-index: 1;
        }
        .owl-carousel .fadeOut {
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }

        @-webkit-keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        /*
         * 	Owl Carousel - Auto Height Plugin
         */
        .owl-height {
            -webkit-transition: height 500ms ease-in-out;
            -moz-transition: height 500ms ease-in-out;
            -ms-transition: height 500ms ease-in-out;
            -o-transition: height 500ms ease-in-out;
            transition: height 500ms ease-in-out;
        }

        /*
         *  Core Owl Carousel CSS File
         */
        .owl-carousel {
            display: none;
            width: 100%;
            -webkit-tap-highlight-color: transparent;
            /* position relative and z-index fix webkit rendering fonts issue */
            position: relative;
            z-index: 1;
        }
        .owl-carousel .owl-stage {
            position: relative;
            -ms-touch-action: pan-Y;
        }
        .owl-carousel .owl-stage:after {
            content: ".";
            display: block;
            clear: both;
            visibility: hidden;
            line-height: 0;
            height: 0;
        }
        .owl-carousel .owl-stage-outer {
            position: relative;
            overflow: hidden;
            /* fix for flashing background */
            -webkit-transform: translate3d(0px, 0px, 0px);
        }
        .owl-carousel .owl-controls .owl-nav .owl-prev,
        .owl-carousel .owl-controls .owl-nav .owl-next,
        .owl-carousel .owl-controls .owl-dot {
            cursor: pointer;
            cursor: hand;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .owl-carousel.owl-loaded {
            display: block;
        }
        .owl-carousel.owl-loading {
            opacity: 0;
            display: block;
        }
        .owl-carousel.owl-hidden {
            opacity: 0;
        }
        .owl-carousel .owl-refresh .owl-item {
            display: none;
        }
        .owl-carousel .owl-item {
            position: relative;
            min-height: 1px;
            float: left;
            -webkit-backface-visibility: hidden;
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .owl-carousel .owl-item img {
            display: block;
            width: 100%;
            -webkit-transform-style: preserve-3d;
        }
        .owl-carousel.owl-text-select-on .owl-item {
            -webkit-user-select: auto;
            -moz-user-select: auto;
            -ms-user-select: auto;
            user-select: auto;
        }
        .owl-carousel .owl-grab {
            cursor: move;
            cursor: -webkit-grab;
            cursor: -o-grab;
            cursor: -ms-grab;
            cursor: grab;
        }
        .owl-carousel.owl-rtl {
            direction: rtl;
        }
        .owl-carousel.owl-rtl .owl-item {
            float: right;
        }

        /* No Js */
        .no-js .owl-carousel {
            display: block;
        }

        /*
         * 	Owl Carousel - Lazy Load Plugin
         */
        .owl-carousel .owl-item .owl-lazy {
            opacity: 0;
            -webkit-transition: opacity 400ms ease;
            -moz-transition: opacity 400ms ease;
            -ms-transition: opacity 400ms ease;
            -o-transition: opacity 400ms ease;
            transition: opacity 400ms ease;
        }
        .owl-carousel .owl-item img {
            transform-style: preserve-3d;
        }

        /*
         * 	Owl Carousel - Video Plugin
         */
        .owl-carousel .owl-video-wrapper {
            position: relative;
            height: 100%;
            background: #000;
        }
        .owl-carousel .owl-video-play-icon {
            position: absolute;
            height: 80px;
            width: 80px;
            left: 50%;
            top: 50%;
            margin-left: -40px;
            margin-top: -40px;
            background: url("owl.video.play.png") no-repeat;
            cursor: pointer;
            z-index: 1;
            -webkit-backface-visibility: hidden;
            -webkit-transition: scale 100ms ease;
            -moz-transition: scale 100ms ease;
            -ms-transition: scale 100ms ease;
            -o-transition: scale 100ms ease;
            transition: scale 100ms ease;
        }
        .owl-carousel .owl-video-play-icon:hover {
            -webkit-transition: scale(1.3, 1.3);
            -moz-transition: scale(1.3, 1.3);
            -ms-transition: scale(1.3, 1.3);
            -o-transition: scale(1.3, 1.3);
            transition: scale(1.3, 1.3);
        }
        .owl-carousel .owl-video-playing .owl-video-tn,
        .owl-carousel .owl-video-playing .owl-video-play-icon {
            display: none;
        }
        .owl-carousel .owl-video-tn {
            opacity: 0;
            height: 100%;
            background-position: center center;
            background-repeat: no-repeat;
            -webkit-background-size: contain;
            -moz-background-size: contain;
            -o-background-size: contain;
            background-size: contain;
            -webkit-transition: opacity 400ms ease;
            -moz-transition: opacity 400ms ease;
            -ms-transition: opacity 400ms ease;
            -o-transition: opacity 400ms ease;
            transition: opacity 400ms ease;
        }
        .owl-carousel .owl-video-frame {
            position: relative;
            z-index: 1;
        }

        /**
 * Owl Carousel v2.2.0
 * Copyright 2013-2016 David Deutsch
 * Licensed under MIT (https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE)
 */
        .owl-theme .owl-dots,.owl-theme .owl-nav{text-align:center;-webkit-tap-highlight-color:transparent}.owl-theme .owl-nav{margin-top:10px}.owl-theme .owl-nav [class*=owl-]{color:#FFF;font-size:14px;margin:5px;padding:4px 7px;background:#D6D6D6;display:inline-block;cursor:pointer;border-radius:3px}.owl-theme .owl-nav [class*=owl-]:hover{background:#869791;color:#FFF;text-decoration:none}.owl-theme .owl-nav .disabled{opacity:.5;cursor:default}.owl-theme .owl-nav.disabled+.owl-dots{margin-top:10px}.owl-theme .owl-dots .owl-dot{display:inline-block;zoom:1}.owl-theme .owl-dots .owl-dot span{width:10px;height:10px;margin:5px 7px;background:#D6D6D6;display:block;-webkit-backface-visibility:visible;transition:opacity .2s ease;border-radius:30px}.owl-theme .owl-dots .owl-dot.active span,.owl-theme .owl-dots .owl-dot:hover span{background:#869791}
    </style>
@endsection




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
                    <img src="{{$store->icon}}" alt="لوگو">
                </div>
                <div class="info">
                    <div class="name">{{$store->name}}</div>
                    <div class="location"><i class="fa fa-map-marker"></i>{{$store->address}}</div>
                </div>
            </div>
            <div class="online">
                <div>.</div>
                <!--<img src="assets/img/Shape-green-.png" alt="on">-->
                <span>رستوران سفارش آنلاین می پزیرد</span>
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
    <div class="main">
        <div class="content__s">
            <div class="row container">
                <div class="row-content-MIC_P">
                    <div class="MIN">
                        <span>منوی رستوران</span>
                        <span>اطلاعات رستوران</span>
                        <span>نظرات مشتریان</span>
                        <!--<div id="tabs-icons" class="tabs">-->
                        <!--<ul>-->
                        <!--<li><a href="#tabs-icons-1">-->
                        <!--<span class="ui-icon ui-icon-flag"></span> منوی رستوران</a>-->
                        <!--</li>-->
                        <!--<li><a href="#tabs-icons-1">-->
                        <!--<span class="ui-icon ui-icon-flag"></span> اطلاعات رستوران</a>-->
                        <!--</li>-->
                        <!--</ul>-->
                        <!--...-->
                        <!--</div>-->
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
            <div class="row container">
                <div class="row-content-category">
                    <div class="category">
                        <div class="category-section__nav">
                            <div class="category-section__nav-btn">
                                <button class="next" id="new-product-next">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                                <button class="prev" id="new-product-prev">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                        <div class="title" id="category-title">
                            <a>همه غذاها</a>
                            @foreach($categories as $category)
                                <a>{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="number-of-member">
                        <div class="member">
                            <span>تعداد اعضا</span>
                            <span>۴۵۶</span>
                        </div>
                        <button class="btn-btn--yellow">
                            <a href="#">عضویت در باشگاه مشتریان</a>
                        </button>
                    </div>
                </div>
            </div>
            {{--<div class="row container">--}}
            {{--<div class="row-content-show-products">--}}
            {{--<div class="show-products">--}}
            {{--<div class="title">--}}
            {{--<i class="fa fa-circle" aria-hidden="true"></i>--}}
            {{--<span>کباب</span>--}}
            {{--</div>--}}
            {{--<hr>--}}
            {{--<div class="product">--}}
            {{--<div class="items offer-items">--}}
            {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
            {{--<a href="#"><img src="assets/img/offer-item.jpeg" alt="image-box"></a>--}}
            {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
            {{--<div class="logo">--}}
            {{--<img src="assets/img/item-logo.png" alt="لوگو">--}}
            {{--</div>--}}
            {{--<div class="info">--}}
            {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
            {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
            {{--<a href="#"><img src="assets/img/offer-item.jpeg" alt="image-box"></a>--}}
            {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
            {{--<div class="logo">--}}
            {{--<img src="assets/img/item-logo.png" alt="لوگو">--}}
            {{--</div>--}}
            {{--<div class="info">--}}
            {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
            {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
            {{--<a href="#"><img src="assets/img/offer-item.jpeg" alt="image-box"></a>--}}
            {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
            {{--<div class="logo">--}}
            {{--<img src="assets/img/item-logo.png" alt="لوگو">--}}
            {{--</div>--}}
            {{--<div class="info">--}}
            {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
            {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
            {{--<a href="#"><img src="assets/img/offer-item.jpeg" alt="image-box"></a>--}}
            {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
            {{--<div class="logo">--}}
            {{--<img src="assets/img/item-logo.png" alt="لوگو">--}}
            {{--</div>--}}
            {{--<div class="info">--}}
            {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
            {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item offer-item">--}}
            {{--<div class="image-box">--}}
            {{--<a href="#"><img src="assets/img/offer-item.jpeg" alt="image-box"></a>--}}
            {{--<span class="offer-percent">تا 30٪</span>--}}
            {{--</div>--}}
            {{--<div class="caption-box">--}}
            {{--<div class="logo">--}}
            {{--<img src="assets/img/item-logo.png" alt="لوگو">--}}
            {{--</div>--}}
            {{--<div class="info">--}}
            {{--<div class="title"><a href="#">رستوران ملل</a></div>--}}
            {{--<div class="location"><i class="fa fa-map-marker"></i>خیابان آزادی</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="cart">--}}
            {{--<div class="header">--}}
            {{--<span>سبدخرید</span>--}}
            {{--<div class="cart-icon">--}}
            {{--<i class="fa fa-shopping-cart" aria-hidden="true"></i>--}}
            {{--<div class="number-pro">۲</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="selected-pro">--}}
            {{--<div class="products">--}}
            {{--<span>جوجه کباب</span>--}}
            {{--<span>۱۸۰۰۰</span>--}}
            {{--<div class="number-of-product">--}}
            {{--<div class="add"><a href="#">+</a></div>--}}
            {{--<div class="number">۲</div>--}}
            {{--<div class="sub"><a href="#">-</a></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<hr>--}}
            {{--<div class="products">--}}
            {{--<span>جوجه کباب</span>--}}
            {{--<span>۱۸۰۰۰</span>--}}
            {{--<div class="number-of-product">--}}
            {{--<div class="add"><a href="#">+</a></div>--}}
            {{--<div class="number">۲</div>--}}
            {{--<div class="sub"><a href="#">-</a></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<hr>--}}
            {{--</div>--}}
            {{--<div class="order-amount">--}}
            {{--<span>مبلغ سفارش :</span>--}}
            {{--<span>۳۶۰۰۰</span>--}}
            {{--</div>--}}
            {{--<hr>--}}
            {{--<div class="delivery-type">--}}
            {{--<span>تحویل غذا :</span>--}}
            {{--<span>در محل رستوران</span>--}}
            {{--<span>ارسال به شما</span>--}}
            {{--</div>--}}
            {{--<button class="btn-order">--}}
            {{--<a href="#">ثبت سفارش</a>--}}
            {{--</button>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>

@endsection


@section('custom-scripts')
    <script src="/js/custom.js"></script>
    <script type="text/javascript">

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



    </script>
@endsection