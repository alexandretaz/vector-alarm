
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chamado</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Nome do Cliente</strong>
                            </div>
                            <div class="col-md-6">
                                {{$client->name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Contrato</strong>
                            </div>
                            <div class="col-md-6">
                                {{$client->contract->client_alias}}({{$client->contract->client_name}})
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Senha</strong>
                            </div>
                            <div class="col-md-6">
                                {{$client->senha}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Contra Senha</strong>
                            </div>
                            <div class="col-md-6">
                                {{$client->contrasenha}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Celular</strong>
                            </div>
                            <div class="col-md-6">
                                {{$client->tel_cel}}
                            </div>
                        </div>
                    </div>
                    @if(!empty($client->contatos_prioridade))
                    <div class="row">
                        <div class="col-md-10">
                            <strong>Contatos Prioridade</strong>
                            <table class="table-striped">
                                <thead>
                                <tr>
                                    <th>Prioridade</th>
                                    <th>Nome</th>
                                    <th>Grau Parentesco</th>
                                    <th>Telefone Celular</th>
                                    <th>Telefone Comercial</th>
                                    <th>Telefone Residencial</th>
                                    <th>Telefone Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($client->contatos_prioridade as $index=>$contato)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{ucwords($contato->nome)}}</td>
                                        <td>{{$contato->parentesco_grau}}</td>
                                        <td>{{$contato->tel_cel}}</td>
                                        <td>{{$contato->tel_com}}</td>
                                        <td>{{$contato->tel_res}}</td>
                                        <td><a href="mailto:{{$contato->email}}">{{$contato->email}}</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Nenhum contato cadastrado</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if(empty($call->closed_at))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Interagir com o chamado</div>
                    <div class="panel-body">
                        <div class="row">
                            <form action = "{{route('chamado.store.interact')}}" method="post">
                                {{  csrf_field()}}
                                <input type="hidden" name="client_id" value="{{$client->id}}">
                                <input type="hidden" name="id" value="{{$call->id}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <div class="form-group">
                                    <p><strong>Fazer Anotação</strong></p>
                                    <textarea name="description" class="col-md-10"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primay" type="submit">Gravar anotação</button>
                                </div>

                            </form>
                            <form action = "{{route('chamado.close')}}" method="post">
                            {{  csrf_field()}}
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$call->id}}">
                                    <input type="hidden" name="type" value="{{$type}}">
                                    <button class="btn btn-danger" type="submit">Fechar Chamado</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{--@if(!empty($call->interactions))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Histórico do Chamado</div>
                    <div class="panel-body">
                        <div class="row">
                            <table class="table table-striped table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Anotação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($call->interactions as $interaction)
                                    <tr>
                                        <td>{{$interaction->datetime}}</td>
                                        <td>{{$interaction->title}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        --}}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md12">
                <div id="map" class="panel-body" style="min-height: 700px">

                </div>
            </div>
        </div>
    </div>
    <script>
        @php
                if(!empty($call->points)){
                $firstPoint = current($call->points);

                    $firstLatitude = $firstPoint->latitude;
                    $firstLongitude = $firstPoint->longitude;
                }
                else{
                    $firstLatitude= -23.7299983333;
                    $firstLongitude=-46.27998833333333;
                }


        @endphp
        var map;
        var center = {lat:  {{$firstLatitude}}, lng:  {{$firstLongitude}};
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
