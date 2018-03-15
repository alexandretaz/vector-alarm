@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <p><a href="{{route('call.list')}}">Chamados</a></p>

                <div id="map" class="panel-body" style="min-height: 700px">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var map;
    var center = {lat:  -23.533773, lng:  -46.625290};
    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 10
        });
        mainMarker = new google.maps.Marker({
            position: center,
            map:map
        });
    }
    function testeMarkers()
    {

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnNmBHNzosBBw32HGR34Qd6JZ4CvmJeWQ&callback=initMap"
        async defer></script>

@endsection
