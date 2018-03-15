@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cliente</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Nome</strong>
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
                                @if(!empty($client->contract) && is_object($client->contract))
                                {{$client->contract->client_alias}}({{$client->contract->client_name}})
                                @endif
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
                                        <td>{{ucwords($prioritarios->nome)}}</td>
                                        <td>{{$prioritarios->parentesco_grau}}</td>
                                        <td>{{$prioritarios->tel_cel}}</td>
                                        <td>{{$prioritarios->tel_com}}</td>
                                        <td>{{$prioritarios->tel_res}}</td>
                                        <td><a href="mailto:{{$prioritarios->email}}">{{$prioritarios->email}}</a></td>
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Abrir Chamado</div>
                    <div class="panel-body">
                        <div class="row">
                        <form action = "{{route('call.store')}}" method="post">
                            {{  csrf_field()}}
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="1" name="type" checked>
                                        Ajuda
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="2">
                                        Alarm
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descrição da Chamada</label>
                                <textarea name="description" class="col-md-10"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primay" type="submit">Criar Chamado</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
