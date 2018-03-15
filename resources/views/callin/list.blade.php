@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Listagem de Chamados</div>
                    <div class="panel-body">
                        <form method="post" action="{{route("chamado.search.client")}}" class="form-inline">
                            <div class="form-group">
                                {{  csrf_field()}}

                            </div>
                        </form>
                        @if(isset($calls) && (!empty($calls['alarm'])||!empty($calls['help'])))
                            @if(!empty($calls['alarm']))
                            <div class="row">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Data da Abertura</th>
                                    <th>Última Alteração</th>
                                    <th>Status</th>
                                    <th>Exibir</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($calls['alarm'] as $alarm)
                                    <tr>
                                        <td>{{$alarm->client->name}}</td>
                                        <td>{{$alarm->created_at}}</td>
                                        <td>{{$alarm->updated_at}}</td>
                                        <td>@if(empty($alarm->closed_at))<span class="text-success text-uppercase"> Fechado</span> @else <span class="text-danger text-uppercase"> Fechado</span>@endif</td>
                                        <td>
                                            <a href="{{route('call.show',['id'=>$alarm->id, 'type'=>1])}}">Abrir Chamado</a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            @endif
                                @if(!empty($calls['help']))
                                    <div class="row">
                                        <table class="table table-responsive table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Data da Abertura</th>
                                                <th>Última Alteração</th>
                                                <th>Status</th>
                                                <th>Exibir</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($calls['help'] as $help)
                                                <tr>
                                                    <td>{{$help->client->name}}</td>
                                                    <td>{{$help->created_at}}</td>
                                                    <td>{{$help->updated_at}}</td>
                                                    <td>@if(!empty($help->closed_at))<span class="bg-success text-success text-uppercase"> Fechado</span> @else <span class="bg-danger text-danger text-uppercase"> Aberto</span>@endif</td>
                                                    <td>
                                                        <a href="{{route('call.show',['id'=>$help->id, 'type'=>1])}}">Abrir Chamado</a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                        @else
                            <strong>Nenhum Chamado Encontrado</strong>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection