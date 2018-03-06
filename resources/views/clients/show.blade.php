@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@if(!$client->id)Novo @else Editar @endif Client</div>
                    <div class="panel-body">
                        <h2>Contrato {{$contract->client_name}}</h2>
                            {{ csrf_field() }}
                            <input type="hidden" name="dependents" value="0">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="clientName" class="col-md-4 control-label">Nome do Cliente</label>

                                <div class="col-md-6">
                                    {{$client->name}}"
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('rg') ? ' has-error' : '' }}">
                                <label for="rg" class="col-md-4 control-label">RG</label>

                                <div class="col-md-6">
                                 {{$client->rg}}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label for="cpf" class="col-md-4 control-label">CPF</label>

                                <div class="col-md-6">
                                    {{$client->cpf}}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tel_res') ? ' has-error' : '' }}">
                                <label for="tel_res" class="col-md-4 control-label">Telefone Residencial</label>

                                <div class="col-md-6">
                                    {{$client->tel_res}}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tel_com') ? ' has-error' : '' }}">
                                <label for="tel_com" class="col-md-4 control-label">Telefone Comercial</label>

                                <div class="col-md-6">
                                    {{$client->tel_com}}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tel_cel') ? ' has-error' : '' }}">
                                <label for="tel_com" class="col-md-4 control-label">Telefone Celular</label>

                                <div class="col-md-6">
                                    {{$client->tel_celular}}
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
                                {{$client->senha}}

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('contrasenha') ? ' has-error' : '' }}">
                                <label for="senha" class="col-md-4 control-label">Contra Senha</label>

                                <div class="col-md-6">
                                    {{$client->contrasenha}}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('procedimentos_especiais') ? ' has-error' : '' }}">
                                <label for="procedimentos_especiais" class="col-md-4 control-label">Procedimentos Especiais</label>

                                <div class="col-md-6">
                                    <p>{{$client->procedimentos_especiais}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/client_id/{{$client->id}}" class="btn btn-primary">
                                        Editar Cliente
                                    </a>
                                </div>
                            </div>
                                @if(empty($client->parent_client))
                                    <h3>Veículos</h3>
                                    @include('clients.veiculos_table',['client',$client])

                                    <h3>Contatos em ordem de prioridade em caso de incidentes</h3>
                                    @include('clients.contatos_prioridade_table',['client',$client])
                                    <h3>Contatos autorizados a fazer alteração no cadastro</h3>
                                    @include('clients.contatos_table',['client',$client])
                                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>