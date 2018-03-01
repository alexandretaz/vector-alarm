@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Contratos</div>
                    <div class="panel-body">
                        <div class="col-md-2 col-md-offset-8">
                            <a href="{{route('contract.add')}}" class="btn btn-success">Adicionar Contrato</a>
                        </div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>Nome do Cliente</th>
                                <th>CNPJ</th>
                                <th>Clientes Cadastrados</th>
                                <th>Criado em</th>
                                <th>Última alteração</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($contracts as $contract)
                                <tr>
                                    <td>{{$contract->client_name}}</td>
                                    <td>{{$contract->client_cnpj}}</td>
                                    <td>{{count($contract->root_clients)}}</td>
                                    <td>{{ Carbon\Carbon::parse($contract->created_at)->format('d/m/Y H:i:s')}}</td>
                                    <td>{{Carbon\Carbon::parse($contract->updated_at)->format('d/m/Y H:i:s')}}</td>
                                    <td>
                                        <a href="/contract/{{$contract->id}}/edit">Editar</a><br>
                                        <a href="/contract/{{$contract->id}}/delete">Apagar</a><br>
                                        <a href="/contract/{{$contract->id}}/clients">Visualizar Clientes</a>

                                    </td>

                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                        {{ $contracts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection