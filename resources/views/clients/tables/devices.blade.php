@php
$devices = $client->devices;
@endphp

<div class="row">
    <div class="col-md-12">
        <table class="table-responsive table-bordered table-striped" style="min-width: 100%">
            <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cel ID</th>
                <th>Autorizado</th>
                <th>Ações</th>

            </tr>
            </thead>
            <tbody>
            @forelse($devices as $indexDevice=>$device)
                    <tr>
                        <td>{{$device->brand}}</td>
                        <td>{{$device->model}}</td>
                        <td>{{$device->imei}}</td>
                        <td>@if($device->authorized==1) Ativo @elseif($device->autorized==0) Inativo @else Cacnelado @endif</td>
                        <td>@if($device->authorized==1)<a href="/device/{{$device->id}}/0">Inativar</a>@elseif($device->autorized==0) <a href="/device/{{$device->id}}/1">Ativar</a>@else Cancelado @endif</td>
                    </tr>
            @empty
                <td colspan="7">Nenhum Aparelho Cadastrado</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>