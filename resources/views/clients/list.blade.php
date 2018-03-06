@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Clientes do Contrato {{$contract->client_alias}} ({{$contract->client_name}}) </div>
                    <div class="panel-body">
                        <div class="col-md-2 col-md-offset-8">
                            <a href="{{route('client.add',['contractId'=>$contract->id])}}" class="btn btn-success">Adicionar Cliente</a>
                        </div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>Nome do Cliente</th>
                                <th>Número de Dependentes</th>
                                <th>Criado em</th>
                                <th>Última alteração</th>
                                <th>Adicionar Dependentes</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($clients as $client)
                                <tr>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->dependents->count()}}</td>
                                    <td>{{ Carbon\Carbon::parse($client->created_at)->format('d/m/Y H:i:s')}}</td>
                                    <td>{{Carbon\Carbon::parse($client->updated_at)->format('d/m/Y H:i:s')}}</td>
                                    <td><a href="/client/{{$client->id}}/dependent/add" class="btn btn-success">Adicionar Dependente</a> </td>
                                    <td>
                                        <a href="/contract/{{$client->id}}/edit">Editar</a>
                                        <a href="/contract/{{$client->id}}/delete">Apagar</a>
                                        <a href="/contract/{{$client->id}}/clients">Visualizar Dependentes</a>
                                    </td>

                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection