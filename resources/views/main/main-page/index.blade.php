@extends('main.master')

@section('title')
    آنیف
@endsection

@section('custom-header')

    @include('main.main-page.components.search-box')

@endsection

    @section('content')
    
        <div class="row container">

            @include('main.main-page.components.offers')
            @include('main.main-page.components.best-restaurant')

        </div>

    @endsection

