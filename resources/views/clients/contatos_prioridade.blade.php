@extends('layouts.app')

@section('content')
    @php
        if(isset($cp) && isset($client->contatos_prioridade[$cp])){
            $contato_prioridade = $client->contatos_prioridade[$cp];
            $contato_prioridadeLabel = $cp+1;
        }
        else{
            $contato_prioridade = new \stdClass();
            $contato_prioridade->nome = null;
            $contato_prioridade->parentesco_grau = null;
            $contato_prioridade->tel_com = null;
            $contato_prioridade->tel_cel = null;
            $contato_prioridade->tel_res = null;
            $contato_prioridade->email= null;
            $contato_prioridadeLabel = 1;
        }

    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@if($contato_prioridadeLabel ===0 )Adicionar @else Editar @endif
                        Contato Prioritário
                    </div>
                    <form action="{{route('contato_prioridade.store')}}" method="post">
                        <div class="panel-body">
                            <h2>Vip {{$client->name}}</h2>
                            {{ csrf_field() }}
                            <h4>

                                Contato em Ordem de Prioridade
                            </h4>
                            <input type="hidden" value="{{$client->id}}" name="client_id">
                            @if(isset($cp) && isset($client->contatos_prioridade[$cp]))
                                <input type="hidden" value="{{$cp}}" name="position">
                            @endif
                            <div class="form-group">
                                <label for="contato_ordem" class="col-md-4 control-label">Ordem</label>

                                <div class="col-md-6">
                                    <input id="cpPlate" type="number" class="form-control"
                                           name="prioridade" value="{{$contato_prioridadeLabel}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cpPlate" class="col-md-4 control-label">Nome</label>

                                <div class="col-md-6">
                                    <input id="cpPlate" type="text" class="form-control"
                                           name="nome" value="{{$contato_prioridade->nome}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cpparentesco_email" class="col-md-4 control-label">Parentesco/Grau</label>

                                <div class="col-md-6">
                                    <input id="cpparentesco_email" type="text" class="form-control"
                                           name="parentesco_grau" value="{{$contato_prioridade->parentesco_grau}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cptel_com" class="col-md-4 control-label">Telefone Comercial</label>

                                <div class="col-md-6">
                                    <input id="cptel_com" type="text" class="form-control"
                                           name="tel_com" value="{{$contato_prioridade->tel_com}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cptel_cel" class="col-md-4 control-label">Telefone Celular</label>

                                <div class="col-md-6">
                                    <input id="cptel_cel" type="text" class="form-control" name="tel_cel"
                                           value="{{$contato_prioridade->tel_cel}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cptel_res" class="col-md-4 control-label">Telefone Residencial</label>

                                <div class="col-md-6">
                                    <input id="cptel_res" type="text" class="form-control" name="tel_res"
                                           value="{{$contato_prioridade->tel_res}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cpemail" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="cpemail" type="text" class="form-control" name="email"
                                           value="{{$contato_prioridade->email}}">
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
