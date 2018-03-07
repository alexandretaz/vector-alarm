@php
$veiculos = $client->veiculo;
@endphp
<div class="row">
    <div class="col-md-12">
        <table class="table-responsive table-bordered table-striped" style="min-width: 100%">
            <thead>
            <tr>
               <th>Placa</th>
                <th>Ano</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Grau</th>
            </tr>
            </thead>
            <tbody>
            @forelse($veiculos as $veiculo)
                @if(!empty($veiculo->placa))
                <tr>
                <td>{{strtoupper($veiculo->placa)}}</td>
                <td>{{$veiculo->ano}}</td>
                <td>{{$veiculo->marca}}</td>
                <td>{{$veiculo->modelo}}</td>
                <td>{{$veiculo->cor}}</td>
                <td>{{$veiculo->grau}}</td>
                </tr>
                @endif
                @empty
                <td colspan="6">Nenhum Veículo Cadastrado</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>