@extends('main.master')

@section('title')
    ثبت نام
@endsection

@section('custom-styles')
    <style>
        form{
            border:1px solid #e5e5e5;
        }
        #content{
            min-height: 775px;
        }
        input[type="text"],
        input[type="password"],
        textarea,
        textarea.form-control {
            font-family:IRANSans !important;
            height: 50px;
            margin: 0;
            padding: 0 20px;
            vertical-align: middle;
            background: #f8f8f8;
            border: 3px solid #ddd;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            line-height: 50px;
            color: #3f3f3f;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
            -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
        }

        textarea,
        textarea.form-control {
            padding-top: 10px;
            padding-bottom: 10px;
            line-height: 30px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        textarea:focus,
        textarea.form-control:focus {
            outline: 0;
            background: #fff;
            border: 3px solid #ccc;
            -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
        }

        input[type="text"]:-moz-placeholder, input[type="password"]:-moz-placeholder,
        textarea:-moz-placeholder, textarea.form-control:-moz-placeholder { color: #888; }

        input[type="text"]:-ms-input-placeholder, input[type="password"]:-ms-input-placeholder,
        textarea:-ms-input-placeholder, textarea.form-control:-ms-input-placeholder { color: #888; }

        input[type="text"]::-webkit-input-placeholder, input[type="password"]::-webkit-input-placeholder,
        textarea::-webkit-input-placeholder, textarea.form-control::-webkit-input-placeholder { color: #888; }



        button.btn {
            height: 50px;
            margin: 0;
            padding: 0 20px;
            vertical-align: middle;
            background: #f9bc2c;
            border: 0;
            font-family: 'IRANSans';
            font-size: 20px;
            font-weight: 300;
            line-height: 50px;
            color: #3f3f3f;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
            text-shadow: none;
            -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
        }

        button.btn:hover { opacity: 0.7;  cursor: pointer;}

        button.btn:active { outline: 0; opacity: 0.6; color: #fff; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; }

        button.btn:focus { outline: 0; opacity: 0.6; background: #fabc05; color: #3f3f3f; }

        button.btn:active:focus, button.btn.active:focus { outline: 0; opacity: 0.6; background: #fabc05; color: #3f3f3f; }



        img { max-width: 100%; }

        ::-moz-selection { background: #19b9e7; color: #fff; text-shadow: none; }
        ::selection { background: #19b9e7; color: #fff; text-shadow: none; }


        .btn-link-1 {
            display: inline-block;
            height: 50px;
            margin: 0 5px;
            padding: 16px 20px 0 20px;
            background: #19b9e7;
            font-size: 16px;
            font-weight: 300;
            line-height: 16px;
            color: #fff;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
        }
        .btn-link-1:hover, .btn-link-1:focus, .btn-link-1:active { outline: 0; opacity: 0.6; color: #fff; }

        .btn-link-2 {
            display: inline-block;
            height: 50px;
            margin: 0 5px;
            padding: 15px 20px 0 20px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid #fff;
            font-size: 16px;
            font-weight: 300;
            line-height: 16px;
            color: #fff;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
        }
        .btn-link-2:hover, .btn-link-2:focus,
        .btn-link-2:active, .btn-link-2:active:focus { outline: 0; opacity: 0.6; background: rgba(0, 0, 0, 0.3); color: #fff; }


        /***** Top menu *****/

        .navbar {
            padding-top: 10px;
            background: #333;
            background: rgba(51, 51, 51, 0.3);
            border: 0;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
        }
        .navbar.navbar-no-bg { background: none; }

        ul.navbar-nav {
            font-size: 16px;
            color: #fff;
        }

        .navbar-inverse ul.navbar-nav li { padding-top: 8px; padding-bottom: 8px; }

        .navbar-inverse ul.navbar-nav li .li-text { opacity: 0.8; }

        .navbar-inverse ul.navbar-nav li a { display: inline; padding: 0; color: #fff; }
        .navbar-inverse ul.navbar-nav li a:hover { color: #fff; opacity: 1; border-bottom: 1px dotted #fff; }
        .navbar-inverse ul.navbar-nav li a:focus { color: #fff; outline: 0; opacity: 1; border-bottom: 1px dotted #fff; }

        .navbar-inverse ul.navbar-nav li .li-social a {
            margin: 0 5px;
            font-size: 28px;
            vertical-align: middle;
        }
        .navbar-inverse ul.navbar-nav li .li-social a:hover,
        .navbar-inverse ul.navbar-nav li .li-social a:focus { border: 0; color: #19b9e7; }

        .navbar-brand {
            width: 123px;
            background: url(../img/logo.png) left center no-repeat;
            text-indent: -99999px;
        }


        /***** Top content *****/

        .inner-bg {
            padding: 40px 0 170px 0;
        }

        .top-content .text {
            color: #fff;
        }

        .top-content .text h1 { color: #fff; }

        .top-content .description {
            margin: 20px 0 10px 0;
        }

        .top-content .description p { opacity: 0.8; }

        .top-content .description a {
            color: #fff;
        }
        .top-content .description a:hover,
        .top-content .description a:focus { border-bottom: 1px dotted #fff; }

        .top-content .top-big-link {
            margin-top: 35px;
        }

        .form-box {
            padding-top: 40px;
        }

        .form-top {
            overflow: hidden;
            padding:15px 0;
            background: #fff;
            -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; border-radius: 4px 4px 0 0;
            display: flex;
            flex-direction: row-reverse;
            border-radius: 4px;
        }

        .form-top-left {
            width: 100%;
            /*padding-top: 25px;*/
        }
        .form-top-left p{
            margin:0;
        }

        .form-top-left h3 { margin-top: 0; }



        .form-bottom {
            /*padding: 25px 25px 30px 25px;*/
            -moz-border-radius: 0 0 4px 4px; -webkit-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px;
            display: flex;
            flex-direction:column;
        }

        .form-bottom .form-group input , .form-bottom .form-group textarea{
            width:100%;
            margin:10px 0;
        }

        form .form-bottom textarea {
            height: 100px;
            background: #fff;
        }

        form .form-bottom button.btn {
            min-width: 105px;
        }

        form .form-bottom .input-error {
            border-color: #f9bc2c;
        }

        form.registration-form fieldset {
            display: none;
        }


        /***** Media queries *****/

        @media (min-width: 992px) and (max-width: 1199px) {}

        @media (min-width: 768px) and (max-width: 991px) {}

        @media (max-width: 767px) {

            .navbar { padding-top: 0; }
            .navbar.navbar-no-bg { background: #333; background: rgba(51, 51, 51, 0.9); }
            .navbar-brand { height: 60px; margin-left: 15px; }
            .navbar-collapse { border: 0; }
            .navbar-toggle { margin-top: 12px; }

            .inner-bg { padding: 40px 0 110px 0; }
            .top-content .top-big-link { margin-top: 25px; }
            .top-content .top-big-link a.btn { margin-top: 10px; }

            .form-bottom { padding-bottom: 25px; }
            form .form-bottom button.btn { margin-bottom: 5px; }
        }

        form.registration-form {
            display: flex;
            flex-direction: column;
            background: rgba(0, 0, 0, 0.7);
            -ms-flex-preferred-size: 70%;
            flex-basis: 70%;
            border-radius: 15px;
            padding: 20px;
            border:none;
        }

        form fieldset{
            border:none;
            display: flex;
            flex-direction: column;
        }

        .buttons {
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-between;
        }
        .buttons button{
            width:49%;
        }
        #content{
            display: none;
        }
        footer{
            margin-top:0;
        }
    </style>
@endsection

@section('custom-header')
    @include('main.auth.components.register-component')
@endsection

@section('custom-scripts')
    <script>


        jQuery(document).ready(function() {

            /*
                Form
            */
            $('.registration-form fieldset:first-child').fadeIn('slow');

            $('.registration-form input[type="text"], .registration-form input[type="password"], .registration-form textarea').on('focus', function() {
                $(this).removeClass('input-error');
            });

            // next step
            $('.registration-form .btn-next').on('click', function() {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;

                parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
                    if( $(this).val() == "" ) {
                        $(this).addClass('input-error');
                        next_step = false;
                    }
                    else {
                        $(this).removeClass('input-error');
                    }
                });

                if( next_step ) {
                    parent_fieldset.fadeOut(400, function() {
                        $(this).next().fadeIn();
                    });
                }

            });

            // previous step
            $('.registration-form .btn-previous').on('click', function() {
                $(this).parents('fieldset').fadeOut(400, function() {
                    $(this).prev().fadeIn();
                });
            });

            // submit
            $('.registration-form').on('submit', function(e) {

                $(this).find('input[type="text"], input[type="password"], textarea').each(function() {
                    if( $(this).val() == "" ) {
                        e.preventDefault();
                        $(this).addClass('input-error');
                    }
                    else {
                        $(this).removeClass('input-error');
                    }
                });

            });


        });


    </script>
@endsection