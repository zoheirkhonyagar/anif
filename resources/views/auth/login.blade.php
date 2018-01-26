{{--@extends('layouts.app')--}}
@extends('main.master')
@section('custom-styles')
    <style>
        #content {
            display: flex;
            min-height: 380px;
            margin: 30px 460px;
            /*border: 1px solid rgba(0,0,0,0.1);*/

        }
        /*#content .container .row .col-md-8{*/
            /*display: flex;*/
            /*margin-bottom: 20px;*/
        /*}*/

        /*#content .container .row .col-md-8  .panel .panel-heading {*/
            /*padding:10px 15px;border-bottom:1px solid transparent;border-top-right-radius:3px;border-top-left-radius:3px*/

        /*}*/

        .row {

        }

        *, :after, :before {
            box-sizing: border-box;
        }

        .panel-default {
            /*border-color: #d3e0e9;*/
            margin-bottom: 22px;
            background-color: #fff;
            border: 1px solid rgba(0,0,255,0.1);
            padding: 60px 60px;
            border-radius: 4px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .panel {

        }
        *, :after, :before {
            box-sizing: border-box;
        }


        .panel-default .panel-heading {
            color: #333;
            background-color: #fff;
            border-color: #d3e0e9;
        }

        .panel-heading {
            padding: 10px 15px;
            border-bottom: 1px solid transparent;
            border-top-right-radius: 3px;
            border-top-left-radius: 3px;
        }
         :after, :before {
              box-sizing: border-box;
          }
        /*.row .col-md-8 .panel-default  {*/
            /*display: flex;*/
            /*align-items: flex-start;*/
            /*flex-direction: column;*/
            /*color: yellow;*/
            /*margin-top: 0px;*/
            /*!*padding:10px 15px;*!*/
            /*border-bottom:2px solid transparent;*/
        /*}*/
        /*.row .col-md-8 .panel-default .panel-heading  {*/
        /*display: flex;*/
        /*align-items: flex-start;*/
        /*flex-direction: column;*/
        /*color: blueviolet;*/
        /*margin-bottom: 50px;*/
        /*!*border: 1px solid rgba(0,0,0,0.1);*!*/
        /*!*padding:10px 15px;*!*/
        /*!*border-bottom:20px solid transparent;*!*/
        /*border-color: #d3e0e9;*/

        /*}*/

        /*.row .col-md-8 .panel-default .form-group {*/
            /*display: flex;*/
            /*align-items: flex-start;*/
            /*flex-direction: column;*/
            /*color: red;*/
            /*margin-top: 10px;*/
            /*!*padding:10px 15px;*!*/
            /*border-bottom:2px solid transparent;*/
        /*}*/



    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ورود به سایت</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">شماره موبایل یا ایمیل</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">رمز عبور</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
