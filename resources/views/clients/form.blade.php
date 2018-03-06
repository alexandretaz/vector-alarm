@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@if(!$client->id)Novo @else Editar @endif Client</div>
                    <div class="panel-body">
                        <h2>Contrato {{$contract->client_name}}</h2>
                        <form class="form-horizontal" method="POST" action="{{ route('client.store') }}">
                            {{ csrf_field() }}
                            @if(!empty($client->id))
                                <input type="hidden" name="id" value="{{$client->id}}">
                            @endif
                            <input type="hidden" name="contract_id" value="{{$contract->id}}">
                            <input type="hidden" name="dependents" value="0">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="clientName" class="col-md-4 control-label">Nome do Cliente</label>

                                <div class="col-md-6">
                                    <input id="clientName" type="text" class="form-control" name="name" value="{{$client->name}}"required>

                                    @if ($errors->has('client_cnpj'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('rg') ? ' has-error' : '' }}">
                                <label for="rg" class="col-md-4 control-label">RG</label>

                                <div class="col-md-6">
                                    <input id="rg" type="text" class="form-control" name="rg" value="{{$client->rg}}"required>

                                    @if ($errors->has('rg'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('rg') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label for="cpf" class="col-md-4 control-label">CPF</label>

                                <div class="col-md-6">
                                    <input id="cpf" type="text" class="form-control" name="cpf" value="{{$client->cpf}}"required>

                                    @if ($errors->has('cpf'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tel_res') ? ' has-error' : '' }}">
                                <label for="tel_res" class="col-md-4 control-label">Telefone Residencial</label>

                                <div class="col-md-6">
                                    <input id="tel_res" type="text" class="form-control" name="tel_res" value="{{$client->tel_res}}">

                                    @if ($errors->has('tel_res'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tel_res') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tel_com') ? ' has-error' : '' }}">
                                <label for="tel_com" class="col-md-4 control-label">Telefone Comercial</label>

                                <div class="col-md-6">
                                    <input id="tel_com" type="text" class="form-control" name="tel_com" value="{{$client->tel_com}}">

                                    @if ($errors->has('tel_com'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tel_com') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tel_cel') ? ' has-error' : '' }}">
                                <label for="tel_com" class="col-md-4 control-label">Telefone Celular</label>

                                <div class="col-md-6">
                                    <input id="tel_com" type="text" class="form-control" name="tel_celular" value="{{$client->tel_celular}}">

                                    @if ($errors->has('tel_celular'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tel_celular') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if(!empty($client->parent_client))
                            <input type="hidden" name="parent_client" value="{{$client->parent_client}}">
                                <div class="form-group{{ $errors->has('grau_parentesco') ? ' has-error' : '' }}">
                                    <label for="relationship" class="col-md-4 control-label">Grau de Parentesco</label>

                                    <div class="col-md-6">
                                        <input id="relationship" type="text" class="form-control" name="grau_parentesco" value="{{$client->name}}"required>

                                        @if ($errors->has('grau_parentesco'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('grau_parentesco') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="form-group{{ $errors->has('senha') ? ' has-error' : '' }}">
                                <label for="senha" class="col-md-4 control-label">Senha</label>

                                <div class="col-md-6">
                                    <input id="senha" type="text" class="form-control" name="senha" value="{{$client->senha}}"required>

                                    @if ($errors->has('senha'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('senha') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('contrasenha') ? ' has-error' : '' }}">
                                <label for="senha" class="col-md-4 control-label">Contra Senha</label>

                                <div class="col-md-6">
                                    <input id="senha" type="text" class="form-control" name="contrasenha" value="{{$client->contrasenha}}"required>

                                    @if ($errors->has('contrasenha'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contrasenha') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('procedimentos_especiais') ? ' has-error' : '' }}">
                                <label for="procedimentos_especiais" class="col-md-4 control-label">Procedimentos Especiais</label>

                                <div class="col-md-6">
                                    <textarea id="procedimentos_especiais" class="form-control" name="procedimentos_especiais" >{{$client->procedimentos_especiais}}</textarea>

                                    @if ($errors->has('procedimentos_especiais'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('procedimentos_especiais') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(empty($client->parent_client))
                                <h3>Veículos</h3>
                                @include('clients.veiculos_form',['client',$client])

                                <h3>Contatos em ordem de prioridade em caso de incidentes</h3>
                            @include('clients.contatos_prioridade',['client',$client])
                                <h3>Contatos autorizados a fazer alteração no cadastro</h3>
                                @include('clients.contatos_autorizados',['client',$client])
                            @endif
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Gravar Cliente
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection