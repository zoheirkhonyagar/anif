<div class="header-bg">
    <div class="header-content container">
        <form role="form" action="{{ route('login-post') }}" method="POST" class="registration-form">

            
            <fieldset id="step_one">
                <div class="form-top">
                    <div class="form-top-left">
                        <h2>ورود به ناحیه کاربری</h2>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="form-group">
                    {{ csrf_field() }}

                        <label class="sr-only" for="form-phone-number">شماره تماس یا ایمیل</label>
                        <input type="text" name="email" placeholder="شماره تماس یا ایمیل" value="{{ old('email') }}" class="form-first-name form-control">
                        @if ($errors->has('email'))
                            <small class="help-block">{{ $errors->first('email') }}</small>
                        @endif
                        
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="confirm-password">Twitter</label>
                        <input type="password" name="password" placeholder="تکرار رمزعبور" class="form-twitter form-control">
                        @if ($errors->has('password'))
                            <small class="help-block">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-next">ورود</button>
                </div>
            </fieldset>

        </form>
    </div>
</div>