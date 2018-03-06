    @for ($car = 0; $car < 5; $car++)
        @php
            if(isset($client->veiculo[$car])){
                $veic = $client->veiculo[$car];
            }
            else{
                $veic = new \stdClass();
                $veic->placa = null;
                $veic->modelo = null;
                $veic->ano = null;
                $veic->cor = null;
                $veic->grau = null;
                $veic->marca= null;
            }
            $veicLabel = $car+1;
        @endphp
                <h4>
                    <a @if($car==0) class="collapsed" @endif role="button" data-toggle="collapse" data-parent="#accordion" href="#heading{{$veicLabel}}"
                       aria-expanded="@if($car==0) true @else false @endif" aria-controls="heading{{$veicLabel}}">
                        Veículo {{$veicLabel}}
                    </a>
                </h4>
                    <div class="form-group">
                        <label for="carPlate" class="col-md-4 control-label">Placa</label>

                        <div class="col-md-6">
                            <input id="carPlate" type="text" class="form-control"
                                   name="client[veiculo][{{$car}}][placa]" value="{{$veic->placa}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="carmarca" class="col-md-4 control-label">Marca</label>

                        <div class="col-md-6">
                            <input id="carmarca" type="text" class="form-control"
                                   name="client[veiculo][{{$car}}][marca]" value="{{$veic->marca}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="carmodelo" class="col-md-4 control-label">Modelo</label>

                        <div class="col-md-6">
                            <input id="carmodelo" type="text" class="form-control"
                                   name="client[veiculo][{{$car}}][modelo]" value="{{$veic->modelo}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="carano" class="col-md-4 control-label">Ano</label>

                        <div class="col-md-6">
                            <input id="carano" type="text" class="form-control" name="client[veiculo][{{$car}}][ano]"
                                   value="{{$veic->ano}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="carcor" class="col-md-4 control-label">Cor</label>

                        <div class="col-md-6">
                            <input id="carcor" type="text" class="form-control" name="client[veiculo][{{$car}}][cor]"
                                   value="{{$veic->cor}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cargrau" class="col-md-4 control-label">Grau</label>

                        <div class="col-md-6">
                            <input id="cargrau" type="text" class="form-control" name="client[veiculo][{{$car}}][grau]"
                                   value="{{$veic->grau}}">
                        </div>
                    </div>
    @endfor
