<div class="header-bg">
    <div class="header-content container">
        <form role="form" action="" method="post" class="registration-form">

            <fieldset id="step_one">
                <div class="form-top">
                    <div class="form-top-left">
                        <h2>مرحله 1/3</h2>
                        <h3>شماره همراه خود را وارد نمایید :</h3>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="form-group">
                        <label class="sr-only" for="form-phone-number">شماره تماس</label>
                        <input type="text" name="form-phone-number" placeholder="شماره تماس" class="form-first-name form-control" id="form-phone-number">
                        <small class="help-block" id="phone_error" style="display: none;">The username is required</small>
                    </div>
                    <button type="button" id="phone_button" class="btn btn-next">بعدی</button>
                </div>
            </fieldset>

            <fieldset id="step_two">
                <div class="form-top">
                    <div class="form-top-left">
                        <h2>مرحله 2/3</h2>
                        <h3>کد احراز هویت خود را وارد نمایید :</h3>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="form-group">
                        <label class="sr-only" for="form-email">کد تایید</label>
                        <input type="text" name="verify" placeholder="کد تایید" class="form-email form-control" id="form-verify">
                        <small class="help-block" id="verify_error" style="display: none;">The username is required</small>
                    </div>
                    <button type="button" id="verify_button" class="btn btn-next">بعدی</button>
                </div>
            </fieldset>

            <fieldset id="step_three">
                <div class="form-top">
                    <div class="form-top-left">
                        <h2>مرحله 3/3</h2>
                        <h3>کد احراز هویت خود را وارد نمایید :</h3>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="form-group">
                        <label class="sr-only" for="first_name">Facebook</label>
                        <input type="text" name="first_name" placeholder="نام" class="form-facebook form-control" id="form-first-name">
                        <small class="help-block" id="first_name_error" style="display: none;">The username is required</small>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="last_name">Twitter</label>
                        <input type="text" name="last_name" placeholder="نام خانوادگی" class="form-twitter form-control" id="form-last-name">
                        <small class="help-block" id="last_name_error" style="display: none;">The username is required</small>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="password">Twitter</label>
                        <input type="password" name="password" placeholder="رمز عبور" class="form-twitter form-control" id="form-password">
                        <small class="help-block" id="password_error" style="display: none;">The username is required</small>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="confirm-password">Twitter</label>
                        <input type="password" name="password_confirmation" placeholder="تکرار رمزعبور" class="form-twitter form-control" id="form-confirm-password">
                        <small class="help-block" id="confirm_password_error" style="display: none;">The username is required</small>
                    </div>
                    <button type="submit" id="register_button" class="btn">ثبت نام</button>
                </div>
            </fieldset>

            <fieldset id="step_four">
                <div class="form-top">
                    <div class="form-top-left last-anif-register">
                        <h2>ثبت نام شما با موفقیت انجام شد .</h2>
                        <a class="login-anifBtn" href="{{route('login')}}">ورود</a>
                    </div>
                </div>
                
            </fieldset>

        </form>
    </div>
</div>