@extends('main.master')

@section('title')
    آنیف
@endsection

@section('header-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

@section('custom-scripts')
    <script>


        jQuery(document).ready(function() {

            $('select#choose-city').change(function(){
                let selectedCity = $(this).val();
                
                // alert(selectedCity);

                getCityRegions(selectedCity);

                
                // $(arr).each(function(i){
                //     $("#choose-region").append("<option></option>")
                // });

            });

            function getCityRegions(selectedCity) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '{{route("getCityRegions")}}',
                    data: {city_id:selectedCity},
                    success: function(response) {
                        $("#choose-region").empty();//To reset cities
                        let regions = response;
                        for(let i = 0; i < regions.length ; i++){
                            $("#choose-region").append("<option value=\"" + regions[i].id + "\">"+ regions[i].name +"</option>");
                        }
                        // console.log(response);
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                })
            };

// alert('Select field value has changed to' + $(this).val());
            // $.ajax({
            //     type: 'GET',
            //     url: 'changeStatus.php', 
            //     data: {selectFieldValue: $('select.changeStatus').val()},
            //     success: function(html){ Do something with the response },
            //     dataType: 'html'
            // });
        });


    </script>
@endsection

