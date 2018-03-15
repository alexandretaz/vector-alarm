@php
if(!empty($client->veiculo))
    $veiculos = $client->veiculo;
else
    $veiculos = [];
@endphp
<div class="row">
    <div class="col-md-12">
        <p class="right"><a href="{{route('car.add',['clientId'=>$client->id])}}" class="btn btn-primary">Adicionar Veículo</a></p>
        <table class="table-responsive table-bordered table-striped" style="min-width: 100%">
            <thead>
            <tr>
               <th>Placa</th>
                <th>Ano</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Grau</th>
                <th>Ações</th>
            </tr>
            </thead>

            <tbody>
            @forelse($veiculos as $indexVeiculo=>$veiculo)
                @if(!empty($veiculo->placa))
                <tr>
                <td>{{strtoupper($veiculo->placa)}}</td>
                <td>{{$veiculo->ano}}</td>
                <td>{{$veiculo->marca}}</td>
                <td>{{$veiculo->modelo}}</td>
                <td>{{$veiculo->cor}}</td>
                <td>{{$veiculo->grau}}</td>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item"><a class="btn btn-info" href="{{route('car.edit',['clientId'=>$client->id, 'carPosition'=>$indexVeiculo])}}">Editar</a></li>
                            <li class="list-group-item"><a class="btn btn-danger" href="{{route('car.delete',['clientId'=>$client->id, 'carPosition'=>$indexVeiculo])}}">Apagar</a></li>
                        </ul>
                    </td>

                </tr>
                @endif
                @empty
                <td colspan="6">Nenhum Veículo Cadastrado</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>