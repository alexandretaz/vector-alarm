@

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <p><a href="{{route('call.list')}}">Temos <span id="callNumbers"></span> Chamados Abertos</a></p>

                <div id="map" class="panel-body" style="min-height: 700px">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnNmBHNzosBBw32HGR34Qd6JZ4CvmJeWQ&callback=initMap"
        async defer></script>
<script>
            @php

                if(!empty($points)){
                $firstPoint = end($points);
                    if(!isset($firstPoint->lat) && !isset($firstPoint->long)) {
                    $firstLatitude = (float)$firstPoint->latitude;
                    $firstLongitude = (float)$firstPoint->longitude;
                    }
                    else{
                    $firstLatitude= $firstPoint->lat;
                    $firstLongitude=$firstPoint->long;
                    }
                }
                else{
                    $firstLatitude= -23.7299983333;
                    $firstLongitude=-46.27998833333333;
                }
            
            reset($points);





            @endphp
    var labelIndex = 0;
    var map = null;
    var latitude = {{$firstLatitude}}
    var longitude = {{$firstLongitude}}
        function initialize() {
            var latLng = new google.maps.LatLng(latitude, longitude)

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center:latLng
            });
            putPoints();
        }


    // Add a marker at the center of the map.


    @if(isset($points) && !empty($points))
    function addMarker(location, map) {

        var label = ++labelIndex;

        if(location.latitude&&location.longitude) {

            var latitude = parseFloat(location.latitude);
            var longitude = parseFloat(location.longitude);
        }
        else{
            var latitude = parseFloat(location.lat);
            var longitude = parseFloat(location.long);
        }

        var marker = new google.maps.Marker({
            position: {lat:latitude, lng:longitude},
            label: ""+label,
            map: map
        });
    }
    function putPoints() {
        var points = @php echo \json_encode($points)@endphp;
        for (i = 0; i < points.length; i++) {
            addMarker(points[i], map);
        }
    }
    @endif
    google.maps.event.addDomListener(window, 'load', initialize);

</script>

@endsection
