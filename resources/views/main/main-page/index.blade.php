@extends('main.master')

@section('title')
    آنیف
@endsection

@section('custom-header')

    @include('main.main-page.components.search-box')

@endsection

@section('content')

    @include('main.main-page.components.offers')
    @include('main.main-page.components.best-restaurant')

@endsection