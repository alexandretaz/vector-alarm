@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuários</div>
                    <div class="panel-body">
                    <div class="col-md-2 col-md-offset-8">
                        <a href="{{route('user.add')}}" class="btn btn-success">Adicionar Usuário</a>
                    </div>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>email</th>
                                <th>Criado em</th>
                                <th>Última alteração</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s')}}</td>
                                <td>{{Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s')}}</td>
                                <td>
                                    <a href="/user/{{$user->id}}/edit">Editar</a>
                                    <a href="/user/{{$user->id}}/delete">Apagar</a>
                                </td>

                            </tr>
                                @empty
                            @endforelse
                        </tbody>
                    </table>
                        {{ $users->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection