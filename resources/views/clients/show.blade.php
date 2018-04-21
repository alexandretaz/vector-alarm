@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dados do Vip</div>
                    <div class="panel-body">
                        <h2>Vip {{$client->name}}</h2>
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Código</strong>
                            </div>
                            <div class="col-md-6">
                                {{$client->code}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>RG</strong>
                            </div>
                                <div class="col-md-6">
                                 {{$client->rg}}
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>CPF</strong>
                            </div>
                                <div class="col-md-6">
                                    {{$client->cpf}}
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Telefone Residencial</strong>
                            </div>
                                <div class="col-md-6">
                                    {{$client->tel_res}}
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Telefone Comercial</strong>
                            </div>
                                <div class="col-md-6">
                                    {{$client->tel_com}}
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Telefone Celular</strong>
                            </div>
                                <div class="col-md-6">
                                    {{$client->tel_celular}}
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
                            <div class="col-md-10">
                                <strong>Procedimentos Especiais</strong>
                            </div>
                            <div class="col-md-10">
                                <p>{{$client->procedimentos_especiais}}</p>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/client/{{$client->id}}/edit" class="btn btn-primary">
                                        Editar Cliente
                                    </a>
                                </div>
                        </div>
                        <div class="row">
                            <h3>Aparelhos cadastrados</h3>
                            @if(!empty($client->devices))
                            @include('clients.tables.devices',['client', $client])
                            @endif
                                @if(empty($client->parent_client))

                                    <h3>Veículos</h3>
                                    @include('clients.tables.veiculos',['client',$client])

                                    <h3>Contatos em ordem de prioridade em caso de incidentes</h3>
                                    @include('clients.tables.contatos_prioritarios',['client',$client])
                                    <h3>Contatos autorizados a fazer alteração no cadastro</h3>
                                    @include('clients.tables.contatos_autorizados',['client',$client])
                                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($client->dependents))
        @include('clients.tables.dependents',['client',$client])
    @endif
    @endsection