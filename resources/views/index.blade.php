@extends('layouts.app')

@section('content')


    @if(isset($positions))

        <script>

            var map;
            function initMap() {
                var lutsk = {lat: 50.742473, lng: 25.320875};
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: lutsk
                });


                $.get('/getPosition', function (data) {
                    data = JSON.parse(data);

                    for(var i=0; i < data.length; i++){

                        var place = data[i];
                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(place[1]), lng: parseFloat(place[2])},
                            title: place[0],
                            map: map
                        });
                    }
                })

                google.maps.event.addListener(map, "rightclick", function(event) {
                    var pos_name = prompt("Please enter name of place:", "");
                    if(pos_name == null || pos_name == ""){
                        throw new Exception();
                    }
                    var pos_descr = prompt("Please enter description of place:", "");
                    if(pos_descr == null || pos_descr == ""){
                        throw new Exception();
                    }
                    var lat = event.latLng.lat();
                    var lng = event.latLng.lng();
                    var params = {
                        p_lat: lat,
                        p_lng: lng,
                        p_name: pos_name,
                        p_descr: pos_descr
                    }
                    $.get('/setPosition', params,  function (data) {

                        location.reload();
                        alert('Successfully add');
                    })
                });


                var geocoder = new google.maps.Geocoder();


                $("#geo-search").click(function () {
                    geocodeAddress(geocoder, map);
                });

            }


            function geocodeAddress(geocoder, resultMap){
                var address = $("#geo-adress").val();

                geocoder.geocode({'address': address}, function (results, status) {
                    if(status === 'OK'){
                        resultMap.setCenter(results[0].geometry.location);
                        resultMap.setZoom(14);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }

        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRtXO1UOCz4RUg1Oqm7m9uTOjfFR3NHdY&callback=initMap">
        </script>





            <div class="intresting-places-block">
                <h1>Google map</h1>
                <span>Для додавання координат клацніть правою кнопкою мишки</span><br><hr>

                <div class="geocodding-block">
                    <form onsubmit="return false;" id="geo-form">
                        {{ csrf_field() }}
                        <label for="geo-adress">Enter adress: </label>
                        <input type="text" id="geo-adress" name="geo-adress">
                        <input type="submit" id="geo-search" name="geo-search" value="Search">
                    </form>
                    <hr>
                </div>

                @foreach($positions as $pos)
                <div class="place">
                    <div class="place-header"><b>Name: </b>{{ $pos->position_name }}</div>
                    <div class="place-position"><b>lat:</b>{{ $pos->position_lat }} <b>lng:</b>{{ $pos->position_lng }}</div>
                    <div class="place-description">{{ $pos->description }}</div>
                    <div class="likes">
                        <form action="{{ route('home') }}", method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="position_id" value="{{ $pos->id }}">
                            <input type="submit" value="Like"> | {{ App\Position::find($pos->id)->like->likes }}
                        </form>
                    </div>
                    <hr>
                </div>
                @endforeach
            </div>
            <div id="map"></div>


    @endif

@endsection

@section('footer')

    @parent
@endsection
