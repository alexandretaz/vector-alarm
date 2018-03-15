@extends('layouts.app')

@section('content')
    @php
        if(isset($contato) && isset($client->contatos_autorizados[$contato])){
            $contatos_autorizados = $client->contatos_autorizados[$contato];

            $contatos_autorizadosLabel = $contato+1;
        }
        else{

            $contatos_autorizados = new \stdClass();
            $contatos_autorizados->nome = null;
            $contatos_autorizados->parentesco_grau = null;
            $contatos_autorizados->tel_com = null;
            $contatos_autorizados->tel_cel = null;
            $contatos_autorizados->tel_res = null;
            $contatos_autorizados->email= null;
            $contatos_autorizadosLabel = 0;
        }

    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@if($contatos_autorizadosLabel ===0 )Adicionar @else Editar @endif Contato Autorizado</div>
                    <form action="{{route('contato_autorizado.store')}}" method="post">
                        <div class="panel-body">
                            <h2>Vip {{$client->name}}</h2>
                            {{ csrf_field() }}
                            <h4>
                                Contato Autorizado @if($contatos_autorizadosLabel==0){{++$contatos_autorizadosLabel}} @else {{$contatos_autorizadosLabel}} @endif
                            </h4>
                            @if(isset($contato))
                            <input type="hidden" value="{{$contato}}" name="position">
                            @endif
                            <input type="hidden" value="{{$client->id}}" name="client_id">
                            <div class="form-group">
                                <label for="caNome" class="col-md-4 control-label">Nome</label>

                                <div class="col-md-6">
                                    <input id="caNome" type="text" class="form-control"
                                           name="nome"
                                           value="{{$contatos_autorizados->nome}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="caparentesco_email" class="col-md-4 control-label">Parentesco/Grau</label>

                                <div class="col-md-6">
                                    <input id="caparentesco_email" type="text" class="form-control"
                                           name="parentesco_grau"
                                           value="{{$contatos_autorizados->parentesco_grau}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catel_com" class="col-md-4 control-label">Telefone Comercial</label>

                                <div class="col-md-6">
                                    <input id="catel_com" type="text" class="form-control"
                                           name="tel_com"
                                           value="{{$contatos_autorizados->tel_com}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catel_cel" class="col-md-4 control-label">Telefone Celular</label>

                                <div class="col-md-6">
                                    <input id="catel_cel" type="text" class="form-control"
                                           name="tel_cel"
                                           value="{{$contatos_autorizados->tel_cel}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catel_res" class="col-md-4 control-label">Telefone Residencial</label>

                                <div class="col-md-6">
                                    <input id="catel_res" type="text" class="form-control"
                                           name="tel_res"
                                           value="{{$contatos_autorizados->tel_res}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="caemail" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="caemail" type="text" class="form-control"
                                           name="email"
                                           value="{{$contatos_autorizados->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
