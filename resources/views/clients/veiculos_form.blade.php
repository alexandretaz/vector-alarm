@extends('layouts.app')

@section('content')
    @php
        if(isset($car) && isset($client->veiculo[$car])){
            $veic = $client->veiculo[$car];
            $edit = true;
        }
        else{
            $veic = new \stdClass();
            $veic->placa = null;
            $veic->modelo = null;
            $veic->ano = null;
            $veic->cor = null;
            $veic->grau = null;
            $veic->marca= null;
            $car = 0;

        }
        $veicLabel = $car+1;
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@if($car ===0 )Adicionar @else Editar @endif Veículo</div>
                    <form action="{{route('car.store')}}" method="post">
                        <div class="panel-body">
                            <h2>Vip {{$client->name}}</h2>
                            {{ csrf_field() }}

                            <h4>
                                Dados do carro

                            </h4>
                            @if(isset($edit) && $edit === true)
                                <input type="hidden" name="car_position" value="{{$car}}">
                            @endif
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <div class="form-group">
                                <label for="carPlate" class="col-md-4 control-label">Placa</label>

                                <div class="col-md-6">
                                    <input id="carPlate" type="text" class="form-control"
                                           name="placa" value="{{$veic->placa}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="carmarca" class="col-md-4 control-label">Marca</label>

                                <div class="col-md-6">
                                    <input id="carmarca" type="text" class="form-control"
                                           name="marca" value="{{$veic->marca}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="carmodelo" class="col-md-4 control-label">Modelo</label>

                                <div class="col-md-6">
                                    <input id="carmodelo" type="text" class="form-control"
                                           name="modelo" value="{{$veic->modelo}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="carano" class="col-md-4 control-label">Ano</label>

                                <div class="col-md-6">
                                    <input id="carano" type="text" class="form-control"
                                           name="ano"
                                           value="{{$veic->ano}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="carcor" class="col-md-4 control-label">Cor</label>

                                <div class="col-md-6">
                                    <input id="carcor" type="text" class="form-control"
                                           name="cor"
                                           value="{{$veic->cor}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cargrau" class="col-md-4 control-label">Grau</label>

                                <div class="col-md-6">
                                    <input id="cargrau" type="text" class="form-control"
                                           name="grau"
                                           value="{{$veic->grau}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection