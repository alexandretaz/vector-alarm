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
                    @if(isset($client->contatos_prioridade) && is_array($client->contatos_prioridade) && !empty($client->contatos_prioridade))
                        <div class="col-md-10">
                            <h4>Contatos Prioridade</h4>
                            <table class="table-striped table table-bordered table-responsive">
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
                                @foreach($client->contatos_prioridade as $index=>$contato)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{ucwords($contato->nome)}}</td>
                                        <td>{{$contato->parentesco_grau}}</td>
                                        <td>{{$contato->tel_cel}}</td>
                                        <td>{{$contato->tel_com}}</td>
                                        <td>{{$contato->tel_res}}</td>
                                        <td><a href="mailto:{{$contato->email}}">{{$contato->email}}</a></td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if(isset($client->veiculo) && is_array($client->veiculo) && !empty($client->veiculo))
                            <div class="col-md-10">
                                <h4>Veículos</h4>
                                <table class="table-striped table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Placa</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Ano</th>
                                        <th>Cor</th>
                                        <th>Grau</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($client->veiculo as $iVeiculo=>$veiculo)
                                        <tr>
                                            <td>{{ucwords($veiculo->placa)}}</td>
                                            <td>{{$veiculo->marca}}</td>
                                            <td>{{$veiculo->modelo}}</td>
                                            <td>{{$veiculo->ano}}</td>
                                            <td>{{$veiculo->cor}}</td>
                                            <td>{{$veiculo->grau}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
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
