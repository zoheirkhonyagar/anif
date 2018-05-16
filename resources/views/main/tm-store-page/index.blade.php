@extends('main.master')

@section('custom-styles')
    <style>
        .register_panel--section {
            display: flex;
            margin: 30px 0 0 0;
        }

        .register_panel--section_item{
            display: flex;
            width: calc(25% - 20px);
            margin: 0 20px;
            align-items: center;
            flex-direction: column;
            background: #3f3f3f;
            padding: 15px 10px;
            color: #fff;
            box-sizing: content-box;
            border: 3px solid #fabc05;
            border-radius: 15px;
        }

        .register_panel--section_item a{
            background: #000;
            color: #fff;
            padding: 10px 15px;
        }

        p.register_panel-description {
            text-align: center;
            line-height: 49px;
        }

        a.register_panel-btn {
            background: #fabc05;
            color: #3f3f3f;
        }

        .register_panel-price {
            margin: 20px 0 0 0;
            display: inline-flex;
        }
    </style>
@endsection

@section('content')
    <div class="container">

        <div class="register_panel--section">
            @foreach($TMPackageM as $item)
            <div class="register_panel--section_item"><span class="register_panel-type">{{$item->name}}</span>
                <div class="register_panel-price">
                    <div class="price"><div class="current">قیمت: {{$item->price}}تومان </div>
                    </div> <span>شارژ تی ام: {{$item->TM}}TM </span></div>
                <p class="register_panel-description">با خرید این بسته اعتبار تی ام شما در آنیف شارژ خواهد شد</p>
                <a href="/api/v1/buyTMPackage?user_id={{ $_GET['user_id'] }}&&package_id={{$item->id}}" class="register_panel-btn">خرید</a>
            </div>
            @endforeach

        </div>

    </div>

@endsection