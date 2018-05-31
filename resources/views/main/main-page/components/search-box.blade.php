<div class="header-bg">
    <div class="header-content container">
        <h2 class="steps">
            <span>انتخاب شهر</span>
            <i class="fa fa-chevron-circle-left fa-2x"></i>
            <span>انتخاب رستوران</span>
            <i class="fa fa-chevron-circle-left fa-2x"></i>
            <span>انتخاب غذا</span>
        </h2>
        <div class="search-box-container">
            <form action="{{ route('search') }}" id="main-search">
            <div class="search-box">
                <div class="choose-boxes">
                    <div class="choose">
                        <div class="choose-item">
                            <i class="fa fa-2x fa-caret-down choose-arrow" aria-hidden="true"></i>
                                <select name="region" id="choose-region">
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            <i class="fa fa-map-marker fa-2x anif-map-marker" aria-hidden="true"></i>
                        </div>
                        <div class="choose-item">
                            <i class="fa fa-2x fa-caret-down choose-arrow" aria-hidden="true"></i>
                                <select name="city" id="choose-city">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{ $city->fa_name }}</option>
                                    @endforeach
                                </select>
                            <i class="fa fa-map-marker fa-2x anif-map-marker" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="search-form">
                        <input class="search-input" name="search-input" type="text" placeholder="نام رستوران مورد نظر را وارد کنید ...">
                        <button class="search-btn" type="submit"><i class="fa fa-search fa-2x"></i></button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>