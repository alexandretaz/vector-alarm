@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Abrir Chamado</div>
                    <div class="panel-body">
                        <form method="post" action="{{route("chamado.search.client")}}" class="form-inline">
                            <div class="form-group">
                                {{  csrf_field()}}
                                <label class="sr-only" for="search">Buscar client</label>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Buscar pelo Cliente">
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </div>
                        </form>
                        @if(isset($clients) && !empty($clients))
                            <table class="table table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th>Nome do Cliente</th>
                                    <th>Senha</th>
                                    <th>Contra Senha</th>
                                    <th>Abrir Chamado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clients as $client)
                                    <tr>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->senha}}</td>
                                        <td>{{$client->contrasenha }}</td>
                                        <td>
                                            <a href="{{route('call.add.client',['id'=>$client->id])}}">Abrir Chamado</a>
                                        </td>

                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection